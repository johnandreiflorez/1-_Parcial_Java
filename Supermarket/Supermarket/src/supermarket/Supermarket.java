package supermarket;
import java.io.IOException;

public class Supermarket {

    public static void main(String[] args) throws IOException {
        file a =new file();
        String txt;
        txt = a.readTxt("C:\\Users\\COMPUFACIL03\\Desktop\\archivo2.txt");
        //--------------------------------------------------------------------
       for(int j=0;j<5;j++){
          String fil=txt.split(";")[j];
        
            Person p = new Person();
            p.setName(fil.split(",")[0]);
            p.setEmail(fil.split(",")[1]);
            p.setPhoneNumber(fil.split(",")[2]);
            ProcessSale buy = new ProcessSale(Double.parseDouble(fil.split(",")[3]));
            buy.setCost(buy.getCost());
            buy.PointSale();
            buy.PrintSale(p.getName(),p.getEmail());
           
       }
    }
    
}
