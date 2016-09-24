<?php

namespace Hackathon\TranslationCollector\Api\Data;

interface TranslationInterface {

    /**
     * Translation token
     */
    const TOKEN = 'token';

    /**
     * Type of origin
     */
    const TYPE = 'type';

    /**
     * Module of translation
     */
    const MODULE = 'module';

    /**
     *  Returns token of translation
     *
     * @return mixed
     */
    public function getToken();

    /**
     *  Sets token of translation
     *
     * @param $token
     * @return mixed
     */
    public function setToken($token);

    /**
     *  Returns type of translation
     *
     * @return mixed
     */
    public function getType();

    /**
     *  Sets type of translation
     *
     * @param $type
     * @return mixed
     */
    public function setType($type);

    /**
     *  Returns module where translation is used
     *
     * @return mixed
     */
    public function getModule();

    /**
     *  Sets module where translation is used
     *
     * @param $module
     * @return mixed
     */
    public function setModule($module);

}