<?php

class RequetesSql
{

    public function connexBd(String $nomTable)
    {
        $mysqli = new mysqli("localhost", "root", "", $nomTable);
        return $mysqli;
    }
}
