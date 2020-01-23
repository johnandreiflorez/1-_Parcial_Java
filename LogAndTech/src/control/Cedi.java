
package control;
import structure.Stack;
import model.Product;
import logandtech.*;

public class Cedi {
    Product productInfo;
    Truck tr;
    ReadFile r;
    Accounting account;
     Stack p;
    public Cedi(){
        p=new Stack(100);
        tr = new Truck();
        account = new Accounting(); 
    }

    public Stack getP() {
        return p;
    }
    
    public void addToTruck(){
        r = new ReadFile();
        r.openFile();
        String txt = r.readLine();
        //-----------------------------------------
        while(!txt.equals("end")){
        //------- SEGUNDA PARTE (MANDAR LA PILA A TRUCK)----------------------
        //--------SE MANDA LA PILA PARA REALIZAR CALCULO----------------------
        //-----------Y  VULVE A CREAR LA PILA GENERICA------------------------
            if(txt.equals("Pila")){
                account.losses(p);
                tr.fillTruck(p);
                p=new Stack(100);
            }else{
        //---------- PRIMERA PARTE (LLENAR EL OBJETO)-------------------------
        //------------ Y MANDAR A LA PILA GENERICA ---------------------------
                if(txt.split(":")[0].equals("Product name")){
                    llenarPilaGeneral(txt);
                }
            }
            txt = r.readLine(); 
        }
        System.out.println("La perdidad total fue: USD "+account.getTotalLossesTruck());
        //tr.printFree();
    }
    
    public void llenarPilaGeneral(String txt){
        productInfo = new Product();
        // System.out.println(txt);
        productInfo.setName(txt.split(":")[1]);
        txt = r.readLine();
        //System.out.println(txt);
        productInfo.setWeightByUnity(txt.split(":")[1]);
        txt = r.readLine();
        //System.out.println(txt);
        productInfo.setMaxWeight(txt.split(":")[1]);
        txt = r.readLine();
        //System.out.println(txt);
        productInfo.setPrice(txt.split(":")[1]);
        p.push(productInfo);
   
    }
    
    private void showStack (){
        Stack aux = p;
        Product auxP;
        while (!aux.isEmpty()){
            auxP = (Product) aux.pop();
            System.out.println("nombre : "+auxP.getName()+" peso: "+auxP.getWeightByUnity()+" peso maximo: "+
                                auxP.getMaxWeight()+" precio: "+auxP.getPrice());
        }
    }
}
