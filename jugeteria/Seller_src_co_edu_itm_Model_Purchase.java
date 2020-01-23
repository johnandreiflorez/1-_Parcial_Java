package co.edu.itm.Model;

public class Purchase {
    private String date;
    private String code;
    private double amount;
    private String type;
    private int unit;

    public  Purchase() {}

    public Purchase(String dataPurchase) {
        String[] dataPurchaseSplited = dataPurchase.split("_");
        this.date = dataPurchaseSplited[0];
        this.code = dataPurchaseSplited[1];
        this.amount = Double.parseDouble(dataPurchaseSplited[2]);
        this.type = dataPurchaseSplited[3];
        this.unit = Integer.parseInt(dataPurchaseSplited[4]);
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public double getAmount() {
        return amount;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public int getUnit() {
        return unit;
    }

    public void setUnit(int unit) {
        this.unit = unit;
    }

    @Override
    public String toString() {
        return "Purchase{" +
                "date='" + date + '\'' +
                ", code='" + code + '\'' +
                ", amount=" + amount +
                ", type='" + type + '\'' +
                ", unit=" + unit +
                "}\n";
    }
}
