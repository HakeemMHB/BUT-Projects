package main.java.com.datacratie.model;

public class Caracterise {
    private int idProposition;
    private int numTheme;

    public Caracterise() {}

    public Caracterise(int idProposition, int numTheme) {
        this.idProposition = idProposition;
        this.numTheme = numTheme;
    }

    public int getIdProposition() { return idProposition; }
    public void setIdProposition(int idProposition) { this.idProposition = idProposition; }

    public int getNumTheme() { return numTheme; }
    public void setNumTheme(int numTheme) { this.numTheme = numTheme; }
}
