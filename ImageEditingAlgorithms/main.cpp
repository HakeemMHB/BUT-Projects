#include <string>
#include <iostream>
#include <vector>
#include "imageAlgorithms.h"
#include <fstream>

int main(){

    cout << "---------------------------------------------------------------" << endl;
    cout << "         Partie 1 : Noir, Blanc, Gris, Couleur" << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    //Déclaration d'une image carré basique
    Image i({{0, 0, 0, 0}, {0, 0, 255, 255}, {0, 255, 255, 255}, {255, 255, 255, 255}},
            {{0, 0, 255, 255}, {0, 255, 255, 255}, {255, 255, 255, 0}, {255, 255, 0, 0}},
            {{255, 255, 0, 0}, {255, 0, 0, 0}, {0, 0, 0, 0}, {0, 0, 0, 0}});

    cout << "Voici une image carrée basique : " << endl;
    i.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 3 : ComposanteRouge" << endl;
    Image iQ3 = i.composanteRouge();
    cout << "Voici l'image i transformé par la méthode composanteRouge() :" << endl;
    iQ3.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 4 : detection" << endl;
    cout << "Le pixel (0,0,0) est présent et detection() doit renvoyer true :" << endl;
    if(iQ3.detection(0,0,0))
        cout << "Test Reussi" << endl;
    else
        cout << "Test Rate" << endl;


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 5 : niveauGris" << endl;
    Image iQ5 = i.niveauxGris();
    cout << "Voici l'image i transformé par la méthode niveauGris() :" << endl;
    iQ5.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 7 : NoiretBlanc" << endl;
    Image iQ7 = i.noirEtBlanc();
    cout << "Voici l'image i transformé par la méthode noirEtBlanc() :" << endl;
    iQ7.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 8 : histogrammeGris" << endl;
    vector<int> histo = i.histogrammeGris();
    cout << "Voici l'histogramme de gris : " << endl;
    affiche(histo);


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 10 : luminosity" << endl;
    Image iQ10 = i.luminosityUP();
    cout << "Voici l'image i transformé par la méthode luminosityUP() :" << endl;
    iQ10.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 11 : contraste" << endl;
    Image iQ11 = i.contrasteDOWN();
    cout << "Voici l'image i transformé par la méthode contrasteDOWN() :" << endl;
    iQ11.affiche();



    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << "         Partie 2 : Menu et Fichier" << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "TEST" << endl;
    vector<int> choix;
    string nomFichier;
    menu(nomFichier, choix);
    Image IQ21 = i.appliquerFiltre(choix);
    IQ21.creer(nomFichier);



    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << "         Partie 3 : Geometrie" << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 1 : rognerD" << endl;
    Image iQ31 = i.rognerD(5);
    cout << "Voici l'image i transformé par la méthode rognerD() :" << endl;
    iQ31.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 2 et Question 3 : rotationG et rotationD" << endl;
    Image iQ32 = i.rotationG();
    cout << "Voici l'image i transformé par la méthode rotationG() :" << endl;
    iQ32.affiche();
    cout << endl; cout << endl;
    Image iQ33 = i.rotationD();
    cout << "Voici l'image i transformé par la méthode rotationD() :" << endl;
    iQ33.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 4 : retournementH" << endl;
    Image iQ34 = i.retournementH();
    cout << "Voici l'image i transformé par la méthode retournementH() :" << endl;
    iQ34.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 4 bis : retournementV" << endl;
    Image iQ34B = i.retournementV();
    cout << "Voici l'image i transformé par la méthode retournementV() :" << endl;
    iQ34B.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 5 : agrandissement" << endl;
    Image iQ35 = i.agrandissement(2);
    cout << "Voici l'image i transformé par la méthode agrandissement() :" << endl;
    iQ35.affiche();


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 4 bis : retrecissement" << endl;
    Image iQ36 = i.retrecissement(2);
    cout << "Voici l'image i transformé par la méthode retrecissement() :" << endl;
    iQ36.affiche();


    cout << endl; cout << endl;
    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << "         Partie 4 : Filtre" << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;

    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 1 et Question 2" << endl;
    Filtre flouG3 = Filtre({{1.0/16.0,1.0/8.0,1.0/16.0},{1.0/8.0,1.0/4.0,1.0/8.0},{1.0/16.0,1.0/8.0,1.0/16.0}},1);
    Image iQ41 = flouG3.application(iQ35);
    iQ41.affiche();
    cout << endl;
    cout << "Son rayon est de 1" << endl;


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "Question 3" << endl;
    Filtre flouG5 = Filtre({{(1.0/256.0)*1,(1.0/256.0)*4,(1/256.0)*6,(1.0/256.0)*4,(1.0/256.0)*1},
                           {(1.0/256.0)*4,(1.0/256.0)*16,(1.0/256.0)*24,(1.0/256.0)*16,(1/256.0)*4.0},
                           {(1.0/256.0)*6,(1.0/256.0)*24,(1.0/256.0)*36,(1.0/256.0)*24,(1.0/256.0)*6},
                           {(1.0/256.0)*4,(1.0/256.0)*16,(1.0/256.0)*24,(1.0/256.0)*16,(1.0/256.0)*4},
                           {(1.0/256.0)*1,(1.0/256.0)*4,(1.0/256.0)*6,(1.0/256.0)*4,(1.0/256.0)*1}}
                           ,2);
    Image iQ43 = flouG5.application(iQ36);
    iQ43.affiche();
    cout << endl;
    cout << "Son rayon est de 2" << endl;


    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;
    cout << endl; cout << endl;
    cout << "---------------------------------------------------------------" << endl;



    return 0;
}
