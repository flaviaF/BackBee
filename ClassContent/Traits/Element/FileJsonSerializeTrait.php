<?php

namespace BackBee\ClassContent\Traits\Element;

use BackBee\ClassContent\AbstractContent;

/**
 * @author Eric Chau <eric.chau@lp-digital.fr>
 */
trait FileJsonSerializeTrait
{
    /**
     * @see AbstractContent::jsonSerialize
     */
    public function jsonSerialize($format = AbstractContent::JSON_DEFAULT_FORMAT)
    {
        $data = parent::jsonSerialize($format);

        if (AbstractContent::JSON_DEFAULT_FORMAT === $format || AbstractContent::JSON_CONCISE_FORMAT === $format) {
            $data['extra']['file_size'] = null;
            if (null !== $stat = $this->getParamValue('stat')) {
                if (is_string($stat)) {
                    $stat = json_decode($stat, true);
                }

                if (is_array($stat) && isset($stat['size'])) {
                    $data['extra']['file_size'] = $stat['size'];
                }
            }
        }

        return $data;
    }
}
