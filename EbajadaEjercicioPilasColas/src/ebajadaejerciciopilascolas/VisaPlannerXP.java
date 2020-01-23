/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ebajadaejerciciopilascolas;

/**
 *
 * @author docenteitm
 */
public class VisaPlannerXP {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        PersonalDocumentFolder laura 
                = new PersonalDocumentFolder
                ("laura", 28, null);
        
        PersonalDocumentFolder pedrito 
                = new PersonalDocumentFolder
                ("pedrito el escamoso", 78, null);
        
        Stack enero = new Stack(20);
        Stack febrero = new Stack(20);
        
        enero.push(laura);
        febrero.push(pedrito);
        
        Embassy embajada = 
                new Embassy(enero,febrero);
        
        Queue orderedQueue = 
           embajada.getOrderedQueueFromStacks();
        
        
        while(! orderedQueue.isEmpty()){
            PersonalDocumentFolder aux 
               = (PersonalDocumentFolder) orderedQueue.pop();
            System.out.println(aux.getBalance());
        }
    }
    
    //esto va en la clase embajada pilas pues
    public Queue getOrderedQueueFromStacks ()
    {
        Queue respuesta new Queue(
                this.enero.getSize()+this.febrero.getSize());
        
        //combinar pilas en un vector
        PersonalDocumentFolder[] vector = 
              new PersonalDocumentFolder[
                this.enero.getSize()+
                this.febrero.getSize()];
        int controler = 0 ;
        while(!this.enero.isEmpty())
        {
            
            vector[controler] = 
                    (PersonalDocumentFolder) 
                    this.enero.pop();
            controler = controler +1;
            
        }
        //controler =0; esto no
        while(!this.febrero.isEmpty())
        {
            
            vector[controler] = 
                    (PersonalDocumentFolder) 
                    this.febrero.pop();
            controler = controler +1;
            
        }
        
        
        for (i = 0; i < vector.length - 1; i++) {
            for (j = 0; j < vector.length - i - 1; j++) {
                double aux1;
                PersonalDocumentFolder aux2;
                
                aux1 = vector[j+1].getBalance();
                aux2 = vector[j];
                if (aux1 < aux2.getBalance()) {
                    PersonalDocumentFolder
                       aux = vector[j + 1];
                    vector[j + 1] = vector[j];
                    vector[j] = aux;
                }
            }
        }
        
        
        for (int i = 0; i < vector.lenght-1; i++) {
            respuesta.push(vector[i]);
        }
        
        return respuesta;
    }
}
