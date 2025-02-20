package main.java.com.datacratie.model;

public class Budget {
    private int idBudget;
    private long budgetProposition;

    public Budget() {}

    public Budget(int idBudget, long budgetProposition) {
        this.idBudget = idBudget;
        this.budgetProposition = budgetProposition;
    }

    public int getIdBudget() { return idBudget; }
    public void setIdBudget(int idBudget) { this.idBudget = idBudget; }

    public long getBudgetProposition() { return budgetProposition; }
    public void setBudgetProposition(long budgetProposition) { this.budgetProposition = budgetProposition; }
}
