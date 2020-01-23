/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import modelo.Persona;
/**
 *
 * @author COMPUFACIL03
 */
public class ControlPersona {
    //Persona objPersona;

    public ControlPersona() {
    }

    /*public ControlPersona(Persona objPersona) {
        this.objPersona = objPersona;
    }*/
    
    public void guardarInfo(String nombre, Persona objPersona){
        Archivos file = new Archivos();
        file.abrirArchivoEscritura(nombre+".txt");
        String lineaTexto;
        lineaTexto = (objPersona.getCodigo()+ "," + objPersona.getNombre()+ "," + objPersona.getCredito()); 
        file.escribirSaltarLinea(lineaTexto);
        file.cerrarArchivoEscritura();
    }
    public void pasarInfo(Persona objPersona){
        Archivos file = new Archivos();
        file.abrirArchivoLectura("clientes.txt");
        String lineaTexto;
        long n = file.contarLineas();
        file.cerrarArchivoLectura();
        file.abrirArchivoLectura("clientes.txt");
        for(int i =0 ; i<n ; i++){
            lineaTexto = file.leerUnaLineaTexto();
            if(20000000<=(Double.parseDouble(lineaTexto.split(",")[2]))){
                System.out.println("si entra" +i+ "° ingreso");
                objPersona= new Persona(lineaTexto.split(",")[0],lineaTexto.split(",")[1],
                                        lineaTexto.split(",")[2]);
                guardarInfo("clientes2",objPersona);
               /*objPersona=new Persona(lineaTexto.split(",")[0],lineaTexto.split(",")[1],
                                        Double.parseDouble(lineaTexto.split(",")[2]));
                lee la line
                
                */
            }
            
        }
    }
}
