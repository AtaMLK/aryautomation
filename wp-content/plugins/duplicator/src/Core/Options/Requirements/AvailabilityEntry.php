<?php

declare(strict_types=1);

namespace Duplicator\Core\Options\Requirements;

/**
 * Availability outcome of a single option value: the failed requirements and
 * the exclusion messages added by the availability filter. The value is
 * available when it has neither.
 */
class AvailabilityEntry
{
    /** @var scalar */
    private $value;
    /** @var Requirement[] */
    private array $failedRequirements = [];
    /** @var string[] */
    private array $messages = [];

    /**
     * Class constructor
     *
     * @param scalar $value The option value this entry belongs to
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the option value this entry belongs to
     *
     * @return scalar
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * True if the value has no failed requirements and no exclusion messages
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return count($this->failedRequirements) === 0 && count($this->messages) === 0;
    }

    /**
     * Add a requirement that failed its check
     *
     * @param Requirement $requirement The failed requirement
     *
     * @return void
     */
    public function addFailedRequirement(Requirement $requirement): void
    {
        $this->failedRequirements[] = $requirement;
    }

    /**
     * Add an exclusion message not tied to a requirement
     * (used by the availability filter, e.g. managed host exclusions)
     *
     * @param string $message The reason why the value is unavailable (can contain HTML)
     *
     * @return void
     */
    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }

    /**
     * Get the failed requirements
     *
     * @return Requirement[]
     */
    public function getFailedRequirements(): array
    {
        return $this->failedRequirements;
    }

    /**
     * Get the exclusion messages
     *
     * @return string[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * All the unavailability reasons ready for the UI: failed requirement
     * messages with their fix hints (a reason without the remedy doesn't help
     * the user) plus the exclusion messages
     *
     * @return string[]
     */
    public function getReasons(): array
    {
        $reasons = [];
        foreach ($this->failedRequirements as $requirement) {
            $reason = $requirement->getFailMessage();
            if (strlen($requirement->getFixHint()) > 0) {
                $reason .= ' ' . $requirement->getFixHint();
            }
            $reasons[] = $reason;
        }
        return array_merge($reasons, $this->messages);
    }
}
