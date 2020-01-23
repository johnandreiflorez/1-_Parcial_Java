/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import java.io.*;
/**
 *
 * @author COMPUFACIL03
 */
public class Archivos {
    FileWriter objFileWriter;
    PrintWriter objPrintWriter;
    File objFile;
    FileReader objFileReader;
    BufferedReader objBufferedReader;
    public long contarLineas(){
        String lineaTexto;
        long n=0;
        try{
            lineaTexto=objBufferedReader.readLine();
            while(lineaTexto !=null){
                n++;
                lineaTexto=objBufferedReader.readLine();
            }
            
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
            
        return n;
    }    
    public String leerUnaLineaTexto(){
        String lineaTexto="";
        try{
            
            lineaTexto=objBufferedReader.readLine();
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
            
        return lineaTexto;
    }
    public void abrirArchivoLectura(String rutaYNombre){
        try{
            objFile=new File(rutaYNombre);
            objFileReader= new FileReader(objFile);
            objBufferedReader= new BufferedReader(objFileReader);
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    }
    public void cerrarArchivoLectura(){
        try{
            objFileReader.close();
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    }    
    public void abrirArchivoEscritura(String rutaYNombre){
        try{
            objFileWriter=new FileWriter(rutaYNombre,true);
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    }
    public void cerrarArchivoEscritura(){
        try{
            objFileWriter.close();
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    }
    public void escribirSaltarLinea(String lineaTexto){
        try{
            objPrintWriter = new PrintWriter(objFileWriter);
            objPrintWriter.println(lineaTexto);
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    } 
    public void escribirUnaLineaYAlFrente(String lineaTexto){
        try{
            objPrintWriter = new PrintWriter(objFileWriter);
            objPrintWriter.print(lineaTexto);
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
    } 
    public void borrarUnArchivo(String rutaYNombre){
     try{
         File objF = new File(rutaYNombre);
            objF.delete();
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
        
    }
    public void renombrarUnArchivo(String rutaYNombreOld,String rutaYNombreNew){
     try{
         File objF1 = new File(rutaYNombreOld);
         File objF2 = new File(rutaYNombreNew);
         boolean r = objF1.renameTo(objF2);
        }
        catch(Exception objException){
            System.out.println(objException.getMessage());
        }
        
    } 
}

