
package logandtech;
import model.Product;
import structure.Stack;
        
public class Accounting {
   /* private double totalWeight;
    double []vectorWeights;
    double []vectorMaxWeights;
    private Product prod;
    
   public Accounting(){
       totalWeight=0;
       vectorWeights= new double[5];
       vectorMaxWeights = new double[5];
   }
   
   public void losses(Stack pila){
       Stack aux = pila;
       for(int i=0; i<vectorWeights.length; i ++){
           prod = (Product) aux.pop(); 
           vectorWeights[i]= Double.parseDouble(prod.getWeightByUnity());
           vectorMaxWeights[i]= Double.parseDouble(prod.getMaxWeight());
       }
       for(int i=0; i<vectorWeights.length; i ++){
           System.out.println(vectorWeights[i] + " ------------------" + vectorMaxWeights[i]);
       }

       
   }*/ 
    private Product prod;
    private double wbu;
    private double totalLossesTruck;
    
    public Accounting() {
        totalLossesTruck=0;
    }
    public void losses(Stack pila)
    {
        Stack aux = pila;
        Stack rev = new Stack(100);
        double totalLosses=0;
        wbu=0;
        
        while(!aux.isEmpty()){
            prod =(Product)aux.pop();
            rev.push(prod);
            wbu += Double.parseDouble(prod.getWeightByUnity());
        }
        
//        System.out.println("este es el peso de toda la carga: "+ wbu);
        while(!rev.isEmpty()){
            prod =(Product)rev.pop();
            //System.out.println(prod.getWeightByUnity());
            wbu -= Double.parseDouble(prod.getWeightByUnity());
            totalLosses += validation(prod);
            totalLossesTruck += validation(prod);
        }
        print(totalLosses);
    }
    public double validation(Product prod){
        //System.out.println("el peso que tiene eso encima es: "+ wbu + prod.getMaxWeight());
        if((wbu)>(Double.parseDouble(prod.getMaxWeight())))
            return Double.parseDouble(prod.getPrice());
        return 0;
    }
    public void print(Double totalLosses){
        System.out.println("La perdida de esta pila fue: "+ "USD " +totalLosses);
    }

    public double getTotalLossesTruck() {
        return totalLossesTruck;
    }
    
    
    
    
    
    
    
}
