
package control;
import java.io.*;


public class ReadFile {
    BufferedReader objBufferedReader;
    FileReader objFileReader;
    File objFile;
    public ReadFile(){}
    
    public void openFile()
    {
        try{
        objFile=new File("database.txt");
        objFileReader = new FileReader(objFile);
        objBufferedReader = new BufferedReader(objFileReader);
        }catch(Exception e){
            System.err.println("no encontramos ni mierda uishh");
            
        }
    }
    public String readLine()
    {
        String line="";
        try
        {
         line= objBufferedReader.readLine();
        }catch(Exception e)
        {
          System.err.println("no encontramos ni mierda uishh");  
          
        }
        return line;
        
    }
            
    
    
}
