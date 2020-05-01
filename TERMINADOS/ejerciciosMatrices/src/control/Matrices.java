
package control;

public class Matrices {
    int [][] mat;
    int nFil,nCol;

    public Matrices(int[][] mat, int nFil, int nCol) {
        this.mat = mat;
        this.nFil = nFil;
        this.nCol = nCol;
    }
    
    public double promediaDatosMatriz(){
        int suma=0;
        double prom;
        for(int i=0;i<nFil;i++){
            for(int j=0;j<nCol;j++){
                suma +=mat[i][j];
            }
        }
        prom = (double)suma/(nFil*nCol);
        return prom;
    }
    
    public int[][] getMat() {
        return mat;
    }
    public void setMat(int[][] mat) {
        this.mat = mat;
    }
    public int getnFil() {
        return nFil;
    }
    public void setnFil(int nFil) {
        this.nFil = nFil;
    }
    public int getnCol() {
        return nCol;
    }
    public void setnCol(int nCol) {
        this.nCol = nCol;
    }
    
    
}
