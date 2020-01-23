package archivosplanosjavai.controller;
import archivosplanosjavai.model.Cliente;
import archivosplanosjavai.controller.Archivos;

/**
 *
 * @author srestrepo
 */
public class ClienteController {
    
    Cliente cliente;

    public ClienteController(Cliente cliente) {
        this.cliente = cliente;
    }
    
    public void saveCliente() {
        Archivos file = new Archivos();
        file.openWriteFile("clientes.txt");
        String chainClient = cliente.getCodigo() + ", " + cliente.getNombre() + 
            ", " + cliente.getTelefono() + ", " + String.format("%.0f", cliente.getCredito());
        file.writeAndRowJump(chainClient);
        file.closeFileWriter();
    } 
}
