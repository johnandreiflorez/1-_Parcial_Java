
package supermarket;
import java.io.*;

public class file {
    public String readTxt(String address){
        String file="";
        try{
            BufferedReader bf =new BufferedReader(new FileReader(address));
            String temp ="";
            String bfReader;
            while((bfReader=bf.readLine())!=null){
                temp += temp+bfReader;
                
            }
            file=temp;
        }catch(Exception e){
            System.out.println("not find fil");
        }
        return file;
    }
}
