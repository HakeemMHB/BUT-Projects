package main.java.com.datacratie.view;

import javax.swing.*;
import java.awt.*;
import java.sql.*;

public class PropositionValideeFrame extends JFrame {

    private Connection connection;
    private double totalBudget = 0;

    public PropositionValideeFrame() {
        setTitle("Propositions Validées");
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

        JLabel titleLabel = new JLabel("Propositions Validées pour le Groupe " + LoginPage.nomGroupe, JLabel.CENTER);
        titleLabel.setFont(new Font("Arial", Font.BOLD, 16));
        titleLabel.setForeground(new Color(0, 102, 204));
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(titleLabel);

        panel.add(Box.createVerticalStrut(20));

        JPanel propositionsPanel = new JPanel();
        propositionsPanel.setLayout(new BoxLayout(propositionsPanel, BoxLayout.Y_AXIS));

        loadValidatedPropositions(propositionsPanel);

        JScrollPane scrollPane = new JScrollPane(propositionsPanel);
        panel.add(scrollPane);

        // Ajouter un label pour afficher le budget total
        JLabel totalBudgetLabel = new JLabel("Total Budget: " + totalBudget + " €");
        totalBudgetLabel.setFont(new Font("Arial", Font.BOLD, 14));
        totalBudgetLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(Box.createVerticalStrut(20));
        panel.add(totalBudgetLabel);

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

    private void loadValidatedPropositions(JPanel propositionsPanel) {
        String query = "SELECT nomProposition, b.budgetProposition FROM proposition p " +
                "NATURAL JOIN groupe g " +
                "NATURAL JOIN a_pour_budget apb " +
                "NATURAL JOIN budget b " + 
                "WHERE b.budgetProposition IS NOT NULL " +
                "AND g.idGroupe = ?";

        try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
            preparedStatement.setInt(1, LoginPage.idGroupe);

            ResultSet resultSet = preparedStatement.executeQuery();
            while (resultSet.next()) {
                String nomProposition = resultSet.getString("nomProposition");
                float budgetProposition = resultSet.getFloat("budgetProposition");

                JPanel propositionPanel = new JPanel();
                propositionPanel.setLayout(new BoxLayout(propositionPanel, BoxLayout.Y_AXIS));
                propositionPanel.setBorder(BorderFactory.createLineBorder(Color.GRAY));
                propositionPanel.setBackground(new Color(255, 255, 255));

                JPanel nomPanel = new JPanel();
                nomPanel.setLayout(new FlowLayout(FlowLayout.LEFT));
                nomPanel.setBackground(new Color(245, 245, 245));
                JLabel nomLabel = new JLabel(nomProposition);
                nomLabel.setFont(new Font("Arial", Font.BOLD, 14));
                nomLabel.setForeground(new Color(0, 102, 204));
                nomPanel.add(nomLabel);
                
                JPanel budgetPanel = new JPanel();
                budgetPanel.setLayout(new FlowLayout(FlowLayout.LEFT));
                budgetPanel.setBackground(new Color(245, 245, 245));
                JLabel budgetLabel = new JLabel("Budget : " + budgetProposition);
                budgetLabel.setFont(new Font("Arial", Font.PLAIN, 14));
                budgetLabel.setForeground(new Color(0, 102, 204));
                budgetPanel.add(budgetLabel);

                propositionPanel.add(nomPanel);
                propositionPanel.add(Box.createVerticalStrut(5));
                propositionPanel.add(budgetPanel);

                propositionsPanel.add(propositionPanel);
                propositionsPanel.add(Box.createVerticalStrut(15));

                totalBudget += budgetProposition;
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
