package main.java.com.datacratie.view;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Image;
import java.awt.Insets;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.SwingConstants;

public class HomeFrame extends JFrame {

    public HomeFrame() {
        setTitle("DataCratie - Page d'accueil");
        setSize(700, 750);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        setIconImage(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")).getImage());

        JPanel panel = new JPanel(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        panel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));
        panel.setBackground(new Color(230, 230, 250));

        JLabel logoLabel = new JLabel(new ImageIcon(getClass().getResource("/images/logo-arrondi.png")));

        JLabel welcomeLabel = new JLabel(LoginPage.prenomUtilisateur + " " + LoginPage.nomUtilisateur + ", que souhaitez-vous faire ?", SwingConstants.CENTER);
        welcomeLabel.setFont(new Font("Arial", Font.BOLD, 16));

        JButton configBudgetButton = createStyledButton("Configurer les budgets thématiques", "/images/budget.png", new Color(100, 149, 237), 350, 50);
        JButton viewPropositionsButton = createStyledButton("Voir les propositions validées", "/images/budget-Proposition.png", new Color(100, 149, 237), 350, 50);
        JButton viewPropositionsButtonNonValide = createStyledButton("Voir les propositions non validées", "/images/budget-Proposition.png", new Color(100, 149, 237), 350, 50);
        
        JButton logoutButton = createStyledButton("Se déconnecter", "/images/log-out.png", new Color(220, 20, 60), 200, 40);
        addHoverEffect(logoutButton, new Color(178, 34, 34), new Color(220, 20, 60));

        configBudgetButton.addActionListener(e -> {
            dispose();
            new BudgetFrame().setVisible(true);
        });

        viewPropositionsButton.addActionListener(e -> {
            dispose();
            new PropositionValideeFrame().setVisible(true); 
        });
        
        viewPropositionsButtonNonValide.addActionListener(e -> {
            dispose();
            new PropositionsNonValideFrame().setVisible(true); 
        });
        
        logoutButton.addActionListener(e -> {
            dispose();
            System.exit(0);
        });

        gbc.insets = new Insets(10, 0, 10, 0);
        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.anchor = GridBagConstraints.CENTER;
        panel.add(logoLabel, gbc);

        gbc.gridy++;
        panel.add(welcomeLabel, gbc);

        gbc.gridy++;
        panel.add(configBudgetButton, gbc);

        gbc.gridy++;
        panel.add(viewPropositionsButton, gbc);
        
        gbc.gridy++;
        panel.add(viewPropositionsButtonNonValide, gbc);

        gbc.gridy++;
        gbc.insets = new Insets(20, 0, 10, 0);
        panel.add(logoutButton, gbc);

        add(panel);
    }

    private JButton createStyledButton(String text, String iconPath, Color bgColor, int width, int height) {
        JButton button = new JButton(text);
        button.setPreferredSize(new Dimension(width, height));
        button.setBackground(bgColor);
        button.setForeground(Color.WHITE);
        button.setFocusPainted(false);
        button.setFont(new Font("Arial", Font.BOLD, 14));

        ImageIcon icon = new ImageIcon(getClass().getResource(iconPath));
        if (icon.getImage() != null) {
            Image scaledIcon = icon.getImage().getScaledInstance(24, 24, Image.SCALE_SMOOTH);
            button.setIcon(new ImageIcon(scaledIcon));
        }

        button.setHorizontalTextPosition(SwingConstants.RIGHT);
        button.setIconTextGap(10);

        return button;
    }

    private void addHoverEffect(JButton button, Color hoverColor, Color defaultColor) {
        button.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseEntered(MouseEvent e) {
                button.setBackground(hoverColor);
            }

            @Override
            public void mouseExited(MouseEvent e) {
                button.setBackground(defaultColor);
            }
        });
    }
}
