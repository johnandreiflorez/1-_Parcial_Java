/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ejerciciobd;

/**
 *
 * @author docenteitm
 */
import control.*;
import modelo.*;
public class EjercicioBD {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Clientes objClie = new Clientes("2","paco","411");
        ControlClientes objContClie= new ControlClientes(objClie);
        objContClie.guardar();
        
    }
    
}
