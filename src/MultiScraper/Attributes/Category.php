<?php

namespace YeTii\MultiScraper\Attributes;

class Category
{
    protected $value;
    public $site_specific;

    public function __construct($value = null)
    {
        if (!is_null($value)) {
            $this->set($value);
        }
    }

    public function get($default = null)
    {
        if ($this->site_specific) {
            return (object)[
                'category' => $this->value,
                'site'     => $this->site_specific
            ];
        }

        return is_numeric($this->value) ? $this->value : $default;
    }

    public function set($value)
    {
        if (is_numeric($value)) {
            $this->value = (int)$value;
        } elseif (is_object($value) && preg_match('^[a-z0-9]+Category$', get_class($value))) {
            $this->value = $value;
        } else {
            throw new \Exception("Invalid Category", 1);
        }

        return $this;
    }
}