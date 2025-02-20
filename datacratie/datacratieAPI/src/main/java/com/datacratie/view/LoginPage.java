package main.java.com.datacratie.view;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.SQLException;

import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.SwingConstants;

import main.java.com.datacratie.service.LoginService;
import main.java.com.datacratie.utils.DatabaseConnection;

public class LoginPage extends JFrame {

    private JTextField emailField;
    private JPasswordField passwordField;
    private JButton loginButton;
    private JLabel messageLabel;

    public static int idUtilisateur;
    public static int idGroupe;
    public static String nomUtilisateur;
    public static String prenomUtilisateur;
    public static String nomGroupe;
    
    public LoginPage() {
        setTitle("DataCratie - Page de connexion");
        setSize(700, 750);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        setIconImage(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")).getImage());

        JPanel panel = new JPanel(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        panel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));
        panel.setBackground(new Color(230, 230, 250));

        JLabel logoLabel = new JLabel(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")));

        emailField = new JTextField(20);
        passwordField = new JPasswordField(20);
        loginButton = new JButton("Se connecter");
        messageLabel = new JLabel(" ", SwingConstants.CENTER);

        loginButton.setBackground(new Color(100, 149, 237));
        loginButton.setForeground(Color.WHITE);
        loginButton.setFocusPainted(false);
        loginButton.setFont(new Font("Arial", Font.BOLD, 14));

        gbc.insets = new Insets(10, 0, 10, 0);
        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.anchor = GridBagConstraints.CENTER;
        panel.add(logoLabel, gbc);

        gbc.gridy++;
        panel.add(new JLabel("Email:"), gbc);

        gbc.gridy++;
        emailField.setPreferredSize(new Dimension(200, 25));
        panel.add(emailField, gbc);

        gbc.gridy++;
        panel.add(new JLabel("Mot de passe:"), gbc);

        gbc.gridy++;
        passwordField.setPreferredSize(new Dimension(200, 25));
        panel.add(passwordField, gbc);

        gbc.gridy++;
        gbc.insets = new Insets(20, 0, 10, 0);
        panel.add(loginButton, gbc);

        gbc.gridy++;
        gbc.insets = new Insets(5, 0, 0, 0);
        panel.add(messageLabel, gbc);

        add(panel);

        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                handleLogin();
            }
        });
    }

    private void handleLogin() {
        String email = emailField.getText();
        String password = new String(passwordField.getPassword());

        try (Connection connection = DatabaseConnection.getConnection()) {

            LoginService loginService = new LoginService(connection);

            if (loginService.isUserDecideur(email, password)) {
                messageLabel.setText("Connexion réussie !");
                loginService.getUserDetailsByEmail(email);
                dispose();
                new HomeFrame().setVisible(true);
            } else {
                messageLabel.setText("Identifiants invalides ou rôle incorrect.");
            }
        } catch (SQLException ex) {
            messageLabel.setText("Erreur de connexion à la base.");
            ex.printStackTrace();
        }
    }

}
