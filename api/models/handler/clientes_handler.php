<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla CLIENTE.
*/
class ClienteHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id = null;
    protected $nombre = null;
    protected $apellido = null;
    protected $direccion = null;
    protected $telefono = null;
    protected $correo = null;
    protected $clave = null;
    protected $estado = null;

    /*
    *   Métodos para gestionar la cuenta del cliente.
    */

    // Método para verificar las credenciales de inicio de sesión del cliente.
    public function checkUser($username, $password)
    {
        $sql = 'SELECT id_cliente, correo_cliente, clave_cliente, estado_cliente
                FROM clientes
                WHERE correo_cliente = ?';
        $params = array($username);
        if (!($data = Database::getRow($sql, $params))) {
            return false; // Retorna falso si no se encuentra el usuario.
        } else if (password_verify($password, $data['clave_cliente'])) {
            $this->id = $data['id_cliente'];
            $this->correo = $data['correo_cliente'];
            $this->estado = $data['estado_cliente'];
            return true; // Retorna verdadero si las credenciales son válidas.
        } else {
            return false; // Retorna falso si la contraseña no coincide.
        }
    }

    // Método para verificar el estado activo del cliente y establecer la sesión.
    public function checkStatus()
    {
        if ($this->estado) {
            $_SESSION['idCliente'] = $this->id;
            $_SESSION['usuarioCliente'] = $this->nombre;
            $_SESSION['correoCliente'] = $this->correo;
            return true;
        } else {
            return false;
        }
    }

    // Método para verificar si la contraseña actual coincide con la almacenada en la base de datos.
    public function checkPassword($password)
    {
        $sql = 'SELECT clave_cliente
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($_SESSION['idCliente']);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['clave_cliente'])) {
            return true;
        } else {
            return false;
        }
    }

    // Método para cambiar la contraseña del cliente.
    public function changePassword()
    {
        $sql = 'UPDATE clientes
                SET clave_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->clave, $_SESSION['idCliente']);
        return Database::executeRow($sql, $params);
    }

    // Método para leer el perfil del cliente.
    public function readProfile()
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, clave_cliente
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($_SESSION['idCliente']);
        return Database::getRow($sql, $params);
    }

    // Método para editar el perfil del cliente.
    public function editProfile()
    {
        $sql = 'UPDATE clientes
                SET nombre_cliente = ?, apellido_cliente = ?, direccion_cliente = ?, telefono_cliente = ?, correo_cliente = ?   
                WHERE id_cliente = ?';
        $params = array($this->nombre, $this->apellido, $this->direccion, $this->telefono, $this->correo, $_SESSION['idCliente']);
        return Database::executeRow($sql, $params);
    }

    // Método para cambiar el estado del cliente (activo/inactivo).
    public function changeStatus()
    {
        $sql = 'UPDATE clientes
                SET estado_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */

    // Método para buscar clientes por apellido.
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente
                FROM clientes
                WHERE apellido_cliente LIKE ?
                ORDER BY apellido_cliente';
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    // Método para crear un nuevo cliente.
    public function createRow()
    {
        $sql = 'INSERT INTO clientes(nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, clave_cliente)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->apellido, $this->direccion, $this->telefono, $this->correo, $this->clave);
        return Database::executeRow($sql, $params);
    }

    // Método para leer todos los clientes.
    public function readAll()
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, estado_cliente
                FROM clientes
                ORDER BY apellido_cliente';
        return Database::getRows($sql);
    }

    // Método para leer un cliente específico por su ID.
    public function readOne()
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, estado_cliente
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    // Método para actualizar los datos de un cliente existente.
    public function updateRow()
    {
        $sql = 'UPDATE clientes
                SET nombre_cliente = ?, apellido_cliente = ?, telefono_cliente = ?, direccion_cliente = ?, correo_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->nombre, $this->apellido, $this->telefono, $this->direccion, $this->correo, $this->id);
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un cliente por su ID.
    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    // Método para verificar si ya existe un cliente con el mismo correo electrónico.
    public function checkDuplicate($value)
    {
        $sql = 'SELECT id_cliente
                FROM clientes
                WHERE correo_cliente = ?';
        $params = array($value);
        return Database::getRow($sql, $params);
    }
}
