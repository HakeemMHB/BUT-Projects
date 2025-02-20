package main.java.com.datacratie.model;

public class APourBudget {
    private int idProposition;
    private int idBudget;

    public APourBudget() {}

    public APourBudget(int idProposition, int idBudget) {
        this.idProposition = idProposition;
        this.idBudget = idBudget;
    }

    public int getIdProposition() { return idProposition; }
    public void setIdProposition(int idProposition) { this.idProposition = idProposition; }

    public int getIdBudget() { return idBudget; }
    public void setIdBudget(int idBudget) { this.idBudget = idBudget; }
}
