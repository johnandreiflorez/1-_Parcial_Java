/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package toystore;
import java.util.Arrays;

public class Costumer {
    private String name;
    private String id;
    private Purchase[] purchases;

    public Costumer(String dataCostumer) {
        String[] dataCostumerSplited = dataCostumer.split("-");
        this.name = dataCostumerSplited[0];
        this.id = dataCostumerSplited[1];
        setPurchasesByString(dataCostumerSplited[2]);
    }

    private void setPurchasesByString(String purchasesString) {
        String[] purchasesStringSplited = purchasesString.split(",");
        purchases = new Purchase[purchasesStringSplited.length];
        for (int i = 0; i < purchasesStringSplited.length; i++) {
            purchases[i] = new Purchase(purchasesStringSplited[i]);
        }
    }

    private String getType() {
        if(sumPurchasesByType("cash") > sumPurchasesByType("credit")){
            return "regular";
        } else {
            return "credit";
        }
    }

    private double sumPurchasesByType(String type) {
        double sum = 0;
        for (int i = 0; i < purchases.length; i++) {
            sum += purchases[i].getType().equalsIgnoreCase(type)?purchases[i].getAmount():0;
        }
        return sum;
    }

    public Purchase getBiggerPurchase() {
        return new Purchase();
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public Purchase[] getPurchases() {
        return purchases;
    }

    public void setPurchases(Purchase[] purchases) {
        this.purchases = purchases;
    }

    public String toStringSimple() {
        return "Costumer{" +
                "name='" + name + '\'' +
                ", type='" + getType() + '\'' +
                "}\n";
    }

    @Override
    public String toString() {
        return "Costumer{" +
                "name='" + name + '\'' +
                ", id='" + id + '\'' +
                ", type='" + getType() + '\'' +
                ", purchases=" + Arrays.toString(purchases) +
                "}\n";
    }
}
