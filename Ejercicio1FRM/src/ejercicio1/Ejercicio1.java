/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ejercicio1;
import javax.swing.JOptionPane;
import modelo.Viaje;
import control.Cotizacion;
/**
 *
 * @author Andrei Florez V
 */
public class Ejercicio1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Viaje objViaje = new Viaje(Integer.parseInt(JOptionPane.showInputDialog("Cual es la distancia a recorre: ")),
                                    Integer.parseInt(JOptionPane.showInputDialog("Cuantos dias de estancia desea: ")));
        Cotizacion objCotizacion = new Cotizacion();
        objCotizacion.generarCosto(objViaje);
        
    }
    
}
