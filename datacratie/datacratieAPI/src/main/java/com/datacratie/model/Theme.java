package main.java.com.datacratie.model;

public class Theme {
    private int numTheme;
    private String nomTheme;
    private long budgetThemeGlobal;

    public Theme() {}

    public Theme(int numTheme, String nomTheme, long budgetThemeGlobal) {
        this.numTheme = numTheme;
        this.nomTheme = nomTheme;
        this.budgetThemeGlobal = budgetThemeGlobal;
    }

    public int getNumTheme() { return numTheme; }
    public void setNumTheme(int numTheme) { this.numTheme = numTheme; }

    public String getNomTheme() { return nomTheme; }
    public void setNomTheme(String nomTheme) { this.nomTheme = nomTheme; }

    public long getBudgetThemeGlobal() { return budgetThemeGlobal; }
    public void setBudgetThemeGlobal(long budgetThemeGlobal) { this.budgetThemeGlobal = budgetThemeGlobal; }
}
