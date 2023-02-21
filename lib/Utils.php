<?php

namespace lib;

class Utils
{
    /*validaciones de tipos de datos usando regex*/
    public static function validarDatosUsuario($data): mixed
    {
        //haciendo uso de las validaciones y sanitaziones validamos todos los datos dentro de $data y devolvemos true si todo es correcto y el error si no lo es
        $data['nombre'] = filter_var($data['nombre'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
        if (htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') && $data['nombre']) {
            $data['apellidos'] = filter_var($data['apellidos'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
            if (htmlspecialchars($data['apellidos'], ENT_QUOTES, 'UTF-8') && $data['apellidos']) {
                $data['email'] = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
                if (htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') && $data['email']) {
                    $data['password'] = filter_var($data['password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                    if (htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8') && $data['password']) {
                        $data['rol'] = filter_var($data['rol'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                        if (htmlspecialchars($data['rol'], ENT_QUOTES, 'UTF-8') && $data['rol']) {
                            return true;
                        } else {
                            return "Error en el campo rol";
                        }
                    } else {
                        return "Error en el campo password";
                    }
                } else {
                    return "Error en el campo email";
                }
            } else {
                return "Error en el campo apellidos";
            }
        } else {
            return "Error en el campo nombre";
        }
    }

    public static function validarDatosProducto(mixed $data)
    {
        $data['nombre'] = filter_var($data['nombre'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
        if (htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') && $data['nombre']) {
            $data['descripcion'] = filter_var($data['descripcion'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
            if (htmlspecialchars($data['descripcion'], ENT_QUOTES, 'UTF-8') && $data['descripcion']) {
                $data['categoria_id'] = filter_var($data['categoria_id'], FILTER_VALIDATE_INT);
                if (htmlspecialchars($data['categoria_id'], ENT_QUOTES, 'UTF-8') && $data['categoria_id']) {
                    $data['precio'] = filter_var($data['precio'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{1,2}\.[0-9]{1,2}$/")));
                    if (htmlspecialchars($data['precio'], ENT_QUOTES, 'UTF-8') && $data['precio']) {
                        $data['stock'] = filter_var($data['stock'], FILTER_VALIDATE_INT);
                        if (htmlspecialchars($data['stock'], ENT_QUOTES, 'UTF-8') && $data['stock']) {
                            $data['oferta'] = filter_var($data['oferta'], FILTER_VALIDATE_INT);
                            if (htmlspecialchars($data['oferta'], ENT_QUOTES, 'UTF-8') && $data['oferta']) {
                                $data['fecha'] = filter_var($data['fecha'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/")));
                                if (htmlspecialchars($data['fecha'], ENT_QUOTES, 'UTF-8') && $data['fecha']) {
                                    return $data;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    //cifrar contraseña
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    //comprobar contraseña
    public static function checkPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}