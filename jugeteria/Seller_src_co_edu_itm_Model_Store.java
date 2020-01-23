package co.edu.itm.Model;

import java.util.Arrays;

public class Store {
    private String name;
    private Costumer[] costumers;

    public Store(String dataStore) {
        String[] dataStoreSplited = dataStore.split(":");
        this.name = dataStoreSplited[0];
        setCostumersByString(dataStoreSplited[1]);
    }

    private void setCostumersByString(String costumersString) {
        String[] costumersStringSplited = costumersString.split(";");
        costumers = new Costumer[costumersStringSplited.length];
        for (int i = 0; i < costumersStringSplited.length; i++) {
            costumers[i] = new Costumer(costumersStringSplited[i]);
        }
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Costumer[] getCostumers() {
        return costumers;
    }

    public void setCostumers(Costumer[] costumers) {
        this.costumers = costumers;
    }

    public String toStringCostumers() {
        String costumersToString = "";
        for (int i = 0; i < costumers.length; i++) {
            costumersToString+= costumers[i].toStringSimple();
        }
        return costumersToString;
    }

    //TODO
    // Call bigger unit purchase by costumer then find biggest unit from costumers
    //@return costumer name + purchase.toString()
    public String getBiggerUnitPurchase() {
        return "";
    }

    //TODO
    // concat all purchases in a new object(purchase,costumerName) array, sort it by amount
    //@return array of costumer name + purchase.toString()
    public String getBiggerUnitPurchase() {
        return "";
    }

    @Override
    public String toString() {
        return "Store{" +
                "name='" + name + '\'' +
                ", costumers=" + Arrays.toString(costumers) +
                '}';
    }
}
