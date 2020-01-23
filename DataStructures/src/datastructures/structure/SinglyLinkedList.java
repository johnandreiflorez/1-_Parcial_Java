package datastructures.structure;
/**
 *
 * @author Foxus
 */

public class SinglyLinkedList {
    private SimpleNode first;
    private SimpleNode last;
    private SimpleNode selected;
    
    /**
     * Inicializa una nueva lista vacia
     */
    public SinglyLinkedList(){
        first = null;
        last = null;
    }
    
    
    
    // #########################################################################
    // PUBLIC METHODS  #########################################################
    // #########################################################################
    /**
     * verdadero si la lista está vacía
     * @return boolean
     */
    public boolean isEmpty()
    {
        return (this.first == null);
    }
    
    /**
     * Agrega un dato al inicio de la lista
     * @param data elemento a insertar
     */
    public void addToTheEnd(Object data)
    {
        SimpleNode newNode = new SimpleNode(data);
      
        if(isEmpty())
        {
            //si la lista está vacia entonces el primer y ultimo elemento son 
            //el que se está agregando
            this.setFirst(newNode);
            this.setLast(newNode);
            this.setSelected(newNode);
        }
       else
        {
            //si no está vacía, se agrega al final
            getLast().setNext(newNode);
            
            //luego de agregar, se actualiza el valor del último. 
            //Éste pasa a ser el nuevo nodo
            setLast(newNode);
            this.setSelected(newNode);
        }  
       
    }
    
    /**
     * agrega el elemento de información 
     * @param data 
     */
    public void addToTheBegining(Object data)
    {
        SimpleNode newNode = new SimpleNode(data);
        
        if(isEmpty())
        {
            //si la lista está vacia entonces el primer y ultimo elemento son 
            //el que se está agregando
            this.setFirst(newNode);
            this.setLast(newNode);
            this.setSelected(newNode);
        } 
        else
        {
            //en la lista no vacia, el primero no tiene anterior.
            //por eso basta con decir que el nuevo nodo apunta al primero
            newNode.setNext(getFirst());

            //luego actualizamos el primero para que sea el nuevo nodo
            setFirst(newNode);
            this.setSelected(newNode);
        }
    }
    
    /**
     * returns the selected element inside the list
     * @return node
     */
    public SimpleNode getSelected() {
        return selected;
    }
    
    public void setSelected(SimpleNode node)
    {
        this.selected = selected;
    }
    
    public Object popAndRemoveHead() {
        //Si la lista está vacía, no hay dato para retornar
        if(isEmpty())
        {
            return null;
        }
        
        Object result = null; 
        if (first == last)
        {
            //si es no vacía obtenemos el dato de la cabeza
            result = getFirst().getData();
            
            //si estamos en la última posición del vector, el primero y el 
            //ultimo serán nulos
            setFirst(null);
            setLast(null);
            setSelected(null);
        } 
        else // si entra al else entonces la lista tiene varios elementos
        {
            //al ser no vacía obtenemos el dato de la cabeza
            result = getFirst().getData();
            
            //al tener varios datos entonces el primero debe actualizarse
            //el nuevo primero es el siguente del viejo primero
            setFirst(
                    getFirst().getNext());
            setSelected(getFirst());
        }
                
                
        return result;
    }
    
    public SimpleNode getFirst() {
        return first;
    }

    public void setFirst(SimpleNode first) {
        this.first = first;
    }

    public SimpleNode getLast() {
        return last;
    }

    public void setLast(SimpleNode last) {
        this.last = last;
    }
    
    
    
}
