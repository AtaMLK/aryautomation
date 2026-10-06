<?php

declare(strict_types=1);

namespace Duplicator\Core\Options\Requirements;

use Duplicator\Core\Exceptions\DupliException;
use Duplicator\Utils\Logging\DupLog;
use Throwable;

/**
 * Atomic environment fact, independent from the plugin configuration.
 *
 * The check callable wraps an existing utility (e.g. SnapUtil::isZlibEnabled())
 * and is evaluated lazily, at most once per request.
 */
class Requirement
{
    /** @var string */
    private string $id;
    /** @var string */
    private string $label;
    /** @var callable(): bool */
    private $check;
    /** @var string */
    private string $failMessage;
    /** @var string|callable(): string resolved to a string at the first getFixHint() call */
    private $fixHint;
    /** @var string */
    private string $docUrl;
    /** @var ?bool cached check result, null if not evaluated yet */
    private ?bool $result = null;

    /**
     * Class constructor
     *
     * @param string                    $id          Unique requirement id
     * @param string                    $label       Human readable label
     * @param callable(): bool          $check       Environment check, evaluated lazily and cached per request
     * @param string                    $failMessage Message shown when the check fails
     * @param string|callable(): string $fixHint     Optional hint on how to fix the failure (can contain HTML).
     *                                               A callable is resolved lazily at the first getFixHint() call,
     *                                               so the hint can depend on the admin page context (rendered
     *                                               templates, action URLs) not available at registration time.
     * @param string                    $docUrl      Optional documentation URL
     */
    public function __construct(
        string $id,
        string $label,
        callable $check,
        string $failMessage,
        $fixHint = '',
        string $docUrl = ''
    ) {
        if (strlen($id) === 0) {
            throw new DupliException(
                'Backup requirement id cannot be empty.',
                DupliException::CODE_OPTIONS_INVALID_CONFIGURATION,
                __('The backup requirements configuration is invalid. Check the backup log for details.', 'duplicator')
            );
        }
        $this->id          = $id;
        $this->label       = $label;
        $this->check       = $check;
        $this->failMessage = $failMessage;
        $this->fixHint     = $fixHint;
        $this->docUrl      = $docUrl;
    }

    /**
     * Get the requirement id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the human readable label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * True if the environment satisfies the requirement.
     * The check runs at most once per request, the result is cached.
     * A check that throws is fail-safe: the requirement is considered not met
     * and the failure is logged, it never propagates to the caller.
     *
     * @return bool
     */
    public function isMet(): bool
    {
        if ($this->result === null) {
            try {
                $this->result = (bool) call_user_func($this->check);
            } catch (Throwable $e) {
                $this->result = false;
                DupLog::trace('Backup requirement check failed. Requirement: ' . $this->id . ' Error: ' . $e->getMessage());
            }
        }
        return $this->result;
    }

    /**
     * Clear the cached check result: the next isMet() call re-runs the check.
     * For the few flows that change the environment the check reads within
     * the same request (see OptionsManager::resetRequirementResults()).
     *
     * @return void
     */
    public function resetResult(): void
    {
        $this->result = null;
    }

    /**
     * Get the failure message
     *
     * @return string
     */
    public function getFailMessage(): string
    {
        return $this->failMessage;
    }

    /**
     * Get the fix hint, resolving and caching it at the first call when it
     * was registered as a callable
     *
     * @return string
     */
    public function getFixHint(): string
    {
        if (!is_string($this->fixHint)) {
            $this->fixHint = (string) call_user_func($this->fixHint);
        }
        return $this->fixHint;
    }

    /**
     * Get the documentation URL
     *
     * @return string
     */
    public function getDocUrl(): string
    {
        return $this->docUrl;
    }
}
