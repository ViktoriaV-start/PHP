<?php

interface Observer
{
    public function notify($vacancyName);
    public function unNotify($vacancyName);

}