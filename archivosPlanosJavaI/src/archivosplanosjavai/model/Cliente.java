package archivosplanosjavai.model;

/**
 *
 * @author srestrepo
 */
public class Cliente {
    
    String codigo;
    String nombre;
    String telefono;
    double credito;

    public Cliente(String codigo, String nombre, String telefono, double credito) {
        this.codigo = codigo;
        this.nombre = nombre;
        this.telefono = telefono;
        this.credito = credito;
    }

    public Cliente() {
        this.codigo = "";
        this.nombre = "";
        this.telefono = "";
        this.credito = 0;
    }

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getTelefono() {
        return telefono;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public double getCredito() {
        return credito;
    }

    public void setCredito(double credito) {
        this.credito = credito;
    }
    
}
