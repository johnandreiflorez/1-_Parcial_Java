
package logandtech;
import model.Product;
import structure.Stack;

public class Truck {
    Stack pr;
    public Truck(){
        pr = new Stack(100);
    }
    public void fillTruck(Stack p){
        pr.push(p);
    }
    //-----------ESTE METODO MUESTRA EL TRUCK-----------
    //----------SI LO NECESITA LO LLAMA--------------
    public void printFree(){
        Stack conver;
        Product converPro;
        Stack aux =pr;
        while(!aux.isEmpty()){
            conver=(Stack) aux.pop();
            while(!conver.isEmpty()){
                converPro=(Product) conver.pop();
                System.out.println("Nombre: " + converPro.getName() + "\n  Peso Unitario: " + converPro.getMaxWeight()+ 
                        "\n  Peso maximo: " + converPro.getMaxWeight() + "\n  Costo: " + converPro.getPrice()+"\n------"
                                + "--------------");
            }
            System.out.println("_____________________________________________________________________\n");
        }
        
    }
}
