/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ebajadaejerciciopilascolas;
import Estructura.Stack;
/**
 *
 * @author salak404
 */
public class Embajada {
    Stack enero;
    Stack febrero;

    public Embajada() {
        enero = new Stack(80);
        febrero = new Stack(80);
    }
    

    public Stack getEnero() {
        return enero;
    }

    public void setEnero(Stack enero) {
        this.enero = enero;
    }

    public Stack getFebrero() {
        return febrero;
    }

    public void setFebrero(Stack febrero) {
        this.febrero = febrero;
    }
    
    /*Stack mes = new Stack(80);
    Queue anio = new Queue(80);
    Archivos objArchivos = new Archivos();
    public void Llenar(){
        
        objArchivos.abrirArchivoLectura();
        int n = objArchivos.contarLineas();
        objArchivos.cerrarArchivoLectura();
        objArchivos.abrirArchivoLectura();
        while(){
            String line = objArchivos.leerUnaLineaTexto();
            if(line.equals("pila")){
                anio.push(mes);
            }else
                if (line.equals("Documentos")){
                    DocumentosPersona objDocumentos = new DocumentosPersona();
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setName(line.split(":")[1]);
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.set(line.split(":")[1]);
                }
                
            
        }
    }*/
}
