/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Control;

import Estructura.*;
import Modelo.DocumentosPersona;
import ebajadaejerciciopilascolas.Embajada;

/**
 *
 * @author COMPUFACIL03
 */
public class AsignacionFecha {
    private Stack mes;
    private Archivos objArchivos;

    public AsignacionFecha() {
         mes = new Stack(80);
          objArchivos = new Archivos();
    }
    
    public void Llenar(){
        int sw = 0;
        Embajada objEmbajada = new Embajada();
        objArchivos.abrirArchivoLectura();
        String line = objArchivos.leerUnaLineaTexto();
        while(!line.equals("end")){
            if(line.equals("pila")){
                if(sw==0){
                    objEmbajada.setEnero(mes);
                    System.out.println("guardo el Enero");
                    sw = 1;
                    mes = new Stack(80);
                }else{
                        objEmbajada.setFebrero(mes);
                        System.out.println("Guardo en Febrero");
                }
                
            }else{
                if (line.equals("Documentos")){
                    System.out.println("si entra");
                    DocumentosPersona objDocumentos = new DocumentosPersona();
                        //lee el nombre 
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setName(line.split(":")[1]);
                        //lee la edad
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setAge(Integer.parseInt(line.split(":")[1]));
                        //lee la ciudad de destino 
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setInterviewDate(line.split(":")[1]);
                        //lee el balance diario
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setBalance(Double.parseDouble(line.split(":")[1]));
                        //lee el titulo
                    line = objArchivos.leerUnaLineaTexto();
                    objDocumentos.setTitle(line.split(":")[1]);
                        // guarda el la pila
                    System.out.println("va a guardar: \n"+objDocumentos.getName()+"\n"+
                                        objDocumentos.getAge()+"\n"+objDocumentos.getInterviewDate()+"\n"+
                                         objDocumentos.getBalance()+"\n"+objDocumentos.getTitle()+"\n");
                    mes.push(objDocumentos);
                    System.out.println("ya guardo esto ^^^\n ________________________________________ ");
                }
            }
            line = objArchivos.leerUnaLineaTexto();
        }
        objArchivos.cerrarArchivoLectura();
        System.out.println("termino el proceso");
    }
}
