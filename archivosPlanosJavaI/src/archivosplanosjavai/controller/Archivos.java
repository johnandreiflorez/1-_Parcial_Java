package archivosplanosjavai.controller;

import java.io.*;

/**
 *
 * @author srestrepo
 */
public class Archivos {
    FileWriter fileWriter;
    PrintWriter printWriter;
    File file;
    FileReader fileReader;
    BufferedReader bufferedReader;
    
    public String readFile(){
        try {
            String ln;
            fileReader = new FileReader(file);
            bufferedReader = new BufferedReader(fileReader);
            
            while((ln = bufferedReader.readLine()) != null){
                System.out.println(ln);
            }
            return ln;
        } catch (Exception e) {
            System.out.println(e.getMessage());
            return "";
        }
    }
    
    public void openFileReader(String rute) {
        try {
            file = new File(rute);
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
    public void closeFileReader(){
        try {
            fileReader.close();
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
    public void openWriteFile(String rute){
        try {
            fileWriter = new FileWriter(rute, true);
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
    public void closeFileWriter(){
        try {
            fileWriter.close();
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
    public void writeAndRowJump(String rowText) {
        try {
            printWriter = new PrintWriter(fileWriter);
            printWriter.println(rowText);
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
    public void writeAndRowFront(String rowText) {
        try {
            printWriter = new PrintWriter(fileWriter);
            printWriter.print(" " + rowText);
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
    
}
