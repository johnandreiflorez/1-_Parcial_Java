/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package coffeecompany;
import java.io.*;
/**
 *
 * @author COMPUFACIL03
 */
public class MyFile {
    FileWriter objFileWriter;
    PrintWriter objPrintWriter;
    MyFile objFile;
    FileReader objFileReader;
    BufferedReader objBufferedReader;
    
    public int contarLineas(){
        String lineaTexto;
        int n=0;
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
            objFile=new MyFile(rutaYNombre);
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


}

