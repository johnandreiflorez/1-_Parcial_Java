/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;

/**
 *
 * @author docenteitm
 */
import modelo.Clientes;
public class ControlClientes {
    Clientes objClientes;

    public ControlClientes(Clientes objClientes) {
        this.objClientes = objClientes;
    }
    public void guardar(){
        String cod,nom,tel;
        cod= objClientes.getCodigo();
        nom=objClientes.getNombre();
        tel=objClientes.getTelefono();
        String cmdSql="INSERT INTO CLIENTES VALUES('"+cod+"','"+nom+"','"+tel+"')";
        Conexion objConexion= new Conexion();
        objConexion.abriBD();
        objConexion.ejecutarUpdate(cmdSql);
        objConexion.cerrarBd();
        
    }
}
