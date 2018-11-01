<?php

namespace Ushahidi\App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

trait MultisiteAwareJob
{

    /**
     * @var int The hostname ID of the previously active deployment
     */
    protected $site_id;

    use SerializesModels {
        __sleep as serializedSleep;
        __wakeup as serializedWakeup;
    }

    public function __sleep()
    {
        $multsite = app('multisite');
        if (!$this->site_id) {
            $this->site_id = $multsite->getSiteId();
            Log::debug('Saving deployment id for job', [$this->site_id]);
        }

        $attributes = $this->serializedSleep();

        return $attributes;
    }

    public function __wakeup()
    {
        if (isset($this->site_id)) {
            Log::debug('Restoring deployment id for job', [$this->site_id]);
            $multisite = app('multisite');
            $multisite->setSiteByID($this->site_id);
        }

        $this->serializedWakeup();
    }
}
