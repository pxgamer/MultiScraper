<?php

namespace YeTii\MultiScraper\Attributes;

class User
{
    protected $value;
    public $site_specific;

    public function __construct($value = null, $instance = null)
    {
        if (!is_null($value)) {
            $this->set($value);
        }
    }

    public function get($default = null)
    {
        if ($this->site_specific) {
            return (object)[
                'username' => $this->value,
                'site'     => $this->site_specific
            ];
        }

        return !is_null($this->value) ? $this->value : $default;
    }

    public function set($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        } elseif (is_object($value) && preg_match('^[a-z0-9]+User$', get_class($value))) {
            $this->value = $value;
        } else {
            throw new \Exception("Invalid User", 1);
        }

        return $this;
    }
}