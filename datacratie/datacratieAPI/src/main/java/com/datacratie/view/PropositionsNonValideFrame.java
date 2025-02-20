package main.java.com.datacratie.view;

import javax.swing.*;
import java.awt.*;
import java.sql.*;

public class PropositionsNonValideFrame extends JFrame {

	private Connection connection;

	public PropositionsNonValideFrame() {
		setTitle("Propositions non validées");
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
		JLabel titleLabel = new JLabel(LoginPage.prenomUtilisateur + " " + LoginPage.nomUtilisateur
				+ ", vous êtes décideur du groupe " + LoginPage.nomGroupe + ".", JLabel.CENTER);
		titleLabel.setFont(new Font("Arial", Font.BOLD, 16));
		titleLabel.setForeground(new Color(0, 102, 204));
		titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
		panel.add(titleLabel);
		panel.add(Box.createVerticalStrut(20));
		panel.add(Box.createVerticalStrut(20));
		panel.add(logoLabel);
		panel.add(Box.createVerticalStrut(20));

		JLabel listTitleLabel = new JLabel("Voici les propositions non validées pour le groupe :", JLabel.CENTER);
		listTitleLabel.setFont(new Font("Arial", Font.BOLD, 14));
		listTitleLabel.setForeground(new Color(100, 100, 100));
		listTitleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
		panel.add(listTitleLabel);

		panel.add(Box.createVerticalStrut(10));

		JPanel propositionsPanel = new JPanel();
		propositionsPanel.setLayout(new BoxLayout(propositionsPanel, BoxLayout.Y_AXIS));

		loadNonValidatedPropositions(propositionsPanel);

		panel.add(propositionsPanel);

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

	private void loadNonValidatedPropositions(JPanel propositionsPanel) {
		String query = "SELECT p.nomProposition, p.idProposition " + "FROM proposition p "
				+ "LEFT JOIN a_pour_budget apb ON p.idProposition = apb.idProposition " + "WHERE apb.idBudget IS NULL "
				+ "AND p.idGroupe = ?";

		try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
			preparedStatement.setInt(1, LoginPage.idGroupe);

			ResultSet resultSet = preparedStatement.executeQuery();
			while (resultSet.next()) {
				String propositionName = resultSet.getString("nomProposition");
				int idProposition = resultSet.getInt("idProposition");

				JPanel propositionPanel = new JPanel();
				propositionPanel.setLayout(new FlowLayout());

				JLabel propositionLabel = new JLabel(propositionName + ": ");
				propositionPanel.add(propositionLabel);

				JTextField budgetField = new JTextField(10);
				propositionPanel.add(budgetField);

				JButton validateButton = new JButton("Valider");
				validateButton.setBackground(new Color(34, 139, 34));
				validateButton.setForeground(Color.WHITE);
				propositionPanel.add(validateButton);

				validateButton.addActionListener(e -> {
					try {
						int newBudget = Integer.parseInt(budgetField.getText());
						String insertQuery = "INSERT INTO a_pour_budget (idProposition, idBudget) VALUES (?, ?)";
						try (PreparedStatement insertStatement = connection.prepareStatement(insertQuery,
								Statement.RETURN_GENERATED_KEYS)) {

							insertStatement.setInt(1, idProposition);
							String insertBudgetQuery = "INSERT INTO budget (budgetProposition) VALUES (?)";
							try (PreparedStatement insertBudgetStatement = connection
									.prepareStatement(insertBudgetQuery, Statement.RETURN_GENERATED_KEYS)) {
								insertBudgetStatement.setInt(1, newBudget);
								insertBudgetStatement.executeUpdate();
								ResultSet generatedKeys = insertBudgetStatement.getGeneratedKeys();
								if (generatedKeys.next()) {
									int generatedBudgetId = generatedKeys.getInt(1);
									insertStatement.setInt(2, generatedBudgetId);
									insertStatement.executeUpdate();
								}
							}
						}
						JOptionPane.showMessageDialog(this,
								"Budget mis à jour pour la proposition: " + propositionName);
						propositionsPanel.remove(propositionPanel);
						propositionsPanel.revalidate();
						propositionsPanel.repaint();

					} catch (NumberFormatException ex) {
						JOptionPane.showMessageDialog(this, "Veuillez entrer un montant valide pour le budget.",
								"Erreur", JOptionPane.ERROR_MESSAGE);
					} catch (SQLException ex) {
						ex.printStackTrace();
					}
				});
				propositionsPanel.add(propositionPanel);
			}
		} catch (
		SQLException e) {
			e.printStackTrace();
		}
	}
}
