package main.java.com.datacratie.view;

import javax.swing.*;
import java.awt.*;
import java.sql.*;

public class BudgetFrame extends JFrame {

    private double budgetGroupe = 0;
    private double budgetProposition = 0;
    private Connection connection;
    private JLabel budgetLabel;

    public BudgetFrame() {
        setTitle("Configuration des Budgets Thématiques");
        setSize(700, 750);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setLocationRelativeTo(null);
        setIconImage(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")).getImage());

        try {
            connection = DriverManager.getConnection("jdbc:mysql://projets.iut-orsay.fr:3306/saes3-lpivet", "saes3-lpivet", "uGEinWjCXRrl2B+r");
        } catch (SQLException e) {
            e.printStackTrace();
        }

        JPanel panel = new JPanel();
        panel.setLayout(new BoxLayout(panel, BoxLayout.Y_AXIS));
        panel.setBackground(new Color(230, 230, 250));
        panel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));

        JLabel logoLabel = new JLabel(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")));
        logoLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        JLabel titleLabel = new JLabel(LoginPage.prenomUtilisateur + " " + LoginPage.nomUtilisateur + ", vous êtes décideur du groupe " + LoginPage.nomGroupe + ".", JLabel.CENTER);
        titleLabel.setFont(new Font("Arial", Font.BOLD, 16));
        titleLabel.setForeground(new Color(0, 102, 204));
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(titleLabel);
        panel.add(Box.createVerticalStrut(20));
        panel.add(Box.createVerticalStrut(20));
        panel.add(logoLabel);
        panel.add(Box.createVerticalStrut(20));

        JLabel listTitleLabel = new JLabel("Voici les thèmes associés au groupe :", JLabel.CENTER);
        listTitleLabel.setFont(new Font("Arial", Font.BOLD, 14));
        listTitleLabel.setForeground(new Color(100, 100, 100));
        listTitleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(listTitleLabel);
        panel.add(Box.createVerticalStrut(10));
        JPanel themesPanel = new JPanel();
        themesPanel.setLayout(new BoxLayout(themesPanel, BoxLayout.Y_AXIS));

        loadGroupThemes(themesPanel);

        panel.add(themesPanel);

        // Initialisation du label de budget
        budgetLabel = new JLabel("Budget du Groupe: " + budgetGroupe + " €");
        budgetLabel.setFont(new Font("Arial", Font.BOLD, 14));
        budgetLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(Box.createVerticalStrut(20));
        panel.add(budgetLabel);

        JButton backButton = new JButton("Retour");
        backButton.setBackground(new Color(0, 102, 204));
        backButton.setForeground(Color.WHITE);
        backButton.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(Box.createVerticalStrut(20));
        panel.add(backButton);
        backButton.addActionListener(e -> {
            HomeFrame homeFrame = new HomeFrame();
            homeFrame.setVisible(true);
            this.dispose();
        });
        add(panel);
    }

    private void loadGroupThemes(JPanel themesPanel) {
        String query = "SELECT t.nomTheme, t.budgetThemeGlobal FROM theme t " +
                       "JOIN compose c ON t.numTheme = c.numTheme " +
                       "WHERE c.idGroupe = ?";

        try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
            preparedStatement.setInt(1, LoginPage.idGroupe);

            ResultSet resultSet = preparedStatement.executeQuery();
            while (resultSet.next()) {
                String themeName = resultSet.getString("nomTheme");
                int budget = resultSet.getInt("budgetThemeGlobal");

                JPanel themePanel = new JPanel();
                themePanel.setLayout(new FlowLayout());

                JLabel themeLabel = new JLabel(themeName + ": ");
                themePanel.add(themeLabel);

                if (budget > 0) {
                    JLabel budgetLabel = new JLabel("Budget: " + budget + " €");
                    themePanel.add(budgetLabel);

                    budgetGroupe += budget;
                } else {
                    JTextField budgetField = new JTextField(10);
                    themePanel.add(budgetField);

                    JButton validateButton = new JButton("Valider");
                    validateButton.setBackground(new Color(34, 139, 34));
                    validateButton.setForeground(Color.WHITE);
                    themePanel.add(validateButton);

                    validateButton.addActionListener(e -> {
                        try {
                            int newBudget = Integer.parseInt(budgetField.getText());
                            String updateQuery = "UPDATE theme SET budgetThemeGlobal = ? WHERE nomTheme = ?";
                            try (PreparedStatement updateStatement = connection.prepareStatement(updateQuery)) {
                                updateStatement.setInt(1, newBudget);
                                updateStatement.setString(2, themeName);
                                updateStatement.executeUpdate();
                                JOptionPane.showMessageDialog(this, "Budget mis à jour pour le thème: " + themeName);

                                themeLabel.setText(themeName + ": ");
                                JLabel updatedBudgetLabel = new JLabel("Budget: " + newBudget + " €");
                                themePanel.removeAll();
                                themePanel.add(themeLabel);
                                themePanel.add(updatedBudgetLabel);

                                budgetGroupe += newBudget;
                                updateGroupBudgetLabel();

                                themePanel.revalidate();
                                themePanel.repaint();
                            }
                        } catch (NumberFormatException ex) {
                            JOptionPane.showMessageDialog(this, "Veuillez entrer un montant valide pour le budget.", "Erreur", JOptionPane.ERROR_MESSAGE);
                        } catch (SQLException ex) {
                            ex.printStackTrace();
                        }
                    });
                }

                themesPanel.add(themePanel);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void updateGroupBudgetLabel() {
        budgetLabel.setText("Budget du Groupe: " + budgetGroupe + " €");
    }
}
