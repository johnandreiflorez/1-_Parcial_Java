package vista;
import control.Matrices;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;

public class FrnMatrices extends javax.swing.JFrame {

    
    public FrnMatrices() {
        initComponents();
    }

    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblTitulo = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        tblMatriz = new javax.swing.JTable();
        lblPromedio = new javax.swing.JLabel();
        txtPromedio = new javax.swing.JTextField();
        btnCalcular = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        getContentPane().setLayout(null);

        lblTitulo.setFont(new java.awt.Font("Dialog", 0, 36)); // NOI18N
        lblTitulo.setText("Matrices");
        getContentPane().add(lblTitulo);
        lblTitulo.setBounds(300, 57, 170, 50);

        tblMatriz.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {},
                {},
                {},
                {}
            },
            new String [] {

            }
        ));
        jScrollPane1.setViewportView(tblMatriz);

        getContentPane().add(jScrollPane1);
        jScrollPane1.setBounds(50, 120, 560, 140);

        lblPromedio.setFont(new java.awt.Font("Dialog", 0, 18)); // NOI18N
        lblPromedio.setText("Promedio");
        getContentPane().add(lblPromedio);
        lblPromedio.setBounds(70, 320, 120, 24);

        txtPromedio.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                txtPromedioActionPerformed(evt);
            }
        });
        getContentPane().add(txtPromedio);
        txtPromedio.setBounds(180, 310, 200, 40);

        btnCalcular.setFont(new java.awt.Font("Dialog", 0, 18)); // NOI18N
        btnCalcular.setText("Calcular");
        btnCalcular.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnCalcularActionPerformed(evt);
            }
        });
        getContentPane().add(btnCalcular);
        btnCalcular.setBounds(460, 320, 100, 30);

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void txtPromedioActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_txtPromedioActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_txtPromedioActionPerformed

    private void btnCalcularActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnCalcularActionPerformed
        // TODO add your handling code here:
        int nF,nC;
        int [][] m;
        nF=Integer.parseInt(JOptionPane.showInputDialog("ingrese el numero de filas") );
        nC=Integer.parseInt(JOptionPane.showInputDialog("ingrese el numero de columnas") );
        m=new int[nF][nC];//separar
        for(int i=0;i<nF;i++){
            for(int j=0;j<nC;j++){
                m[i][j]=Integer.parseInt(JOptionPane.showInputDialog("ingrese mat["+i+","+j+"]") );
            }
        }
        /* paso #1
        definir o declarar la matriz de objetos y String
        */
        Object [][] objMat=new Object[nF][nC];
        String []vecTit=new String [nC];
        /* paso #2
        llenar la matriz de clase Object
        */
        for(int i=0;i<nF;i++){
            for(int j=0;j<nC;j++){
               objMat[i][j]=m[i][j];
            }
        }
        /* paso #3
        definir o declara el objeto modelo
        */
        DefaultTableModel objModel =new DefaultTableModel(objMat,vecTit);
        /* paso #4
        asignar el objeto modelo al Jable
        */
        tblMatriz.setModel(objModel);
        Matrices objMatrices =new Matrices (m,nF,nC);
        double prom=objMatrices.promediaDatosMatriz();
        txtPromedio.setText(Double.toString(prom));
    }//GEN-LAST:event_btnCalcularActionPerformed

  
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(FrnMatrices.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(FrnMatrices.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(FrnMatrices.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(FrnMatrices.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new FrnMatrices().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnCalcular;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JLabel lblPromedio;
    private javax.swing.JLabel lblTitulo;
    private javax.swing.JTable tblMatriz;
    private javax.swing.JTextField txtPromedio;
    // End of variables declaration//GEN-END:variables
}
