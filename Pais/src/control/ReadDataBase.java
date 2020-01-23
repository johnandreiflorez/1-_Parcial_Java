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
public class ReadDataBase {
    BufferedReader objBufferedReader;
    File objFile;
    FileReader objFileReader;

    public ReadDataBase() {
        
    }
    public void openFile (){
        try{
            
            objFile = new File("DataBase.txt");
           objFileReader = new FileReader (objFile);
           objBufferedReader = new BufferedReader(objFileReader);
        }catch(Exception e ){
            System.out.println(e.getMessage());
        }
    }
    public String readerALine (){
        String line="";
        try{
                line = objBufferedReader.readLine();
        }catch (Exception e){
            System.out.println(e.getMessage());
        }
        return line;
    }
    public void closeFile (){
        try {
            objFileReader.close();
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
}
