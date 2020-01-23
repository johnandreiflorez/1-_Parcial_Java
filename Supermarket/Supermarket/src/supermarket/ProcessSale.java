package supermarket;

public class ProcessSale {
    private double cost;
    private int points;
    public ProcessSale(double cost) {
        this.cost = cost;
        this.points=0;
    }

    public double getCost() {
        return cost;
    }
    public void setCost(double cost) {
        this.cost = cost*1.25;
    }
    
    public void PointSale(){
        
        if ((cost-500)>0){
            points+=((cost-500)*3)+200+600;}
        else{
           if ((cost-200)>0)
            points+=((cost-200)*2)+200;
            else
             points = (int)cost;
        }
    }
    public void PrintSale (String name,String email){
        
        System.out.println("the client: "+name+"\n"+
                "total sale tax icluded:-------  € "+(cost)+"\n"+
                "points earned for sale:------- "+points+"\n"+
                "send to E-mail "+email+"\n"+
                "______________________________________________________"+"\n");
    }
}
