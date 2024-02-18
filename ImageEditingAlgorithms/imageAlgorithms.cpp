#include <string>
#include <iostream>
#include <vector>
#include "imageAlgorithms.h"
#include <fstream>


/**
(QUESTION 2) Constructeur renvoyant une erreur si les vecteurs 2D n'ont pas la même taille
**/
Image::Image(vector<vector<int>> red, vector<vector<int>> green, vector<vector<int>> blue){
    int r, g, b;
    r = red.size();
    g = green.size();
    b = blue.size();
    if (r == g && r == b){
        int r1, g1, b1;
        for (int i = 0; i < r; i++){
            r1 = red[i].size();
            g1 = green[i].size();
            b1 = blue[i].size();
            if (r1 != g1 || r1 != b1 || g1 != b1)
                throw invalid_argument("erreur");
        }
        _red = red;
        _green = green;
        _blue = blue;
        _longueur = r1;
        _largeur = r;
    }
    else
        throw invalid_argument("erreur");
}


/**
    Méthode getLongueur renvoyant la longueur de l'image
**/
int Image::getLongueur() const{
    return(_longueur);
}


/**
    Méthode getLargeur renvoyant la largeur de l'image
**/
int Image::getLargeur() const{
    return(_largeur);
}


/**
    Méthode getRed renvoyant le tab 2D rouge
**/
vector<vector<int>> Image::getRed() const{
    return(_red);
}


/**
    Méthode getGreen renvoyant le tab 2D vert
**/
vector<vector<int>> Image::getGreen() const{
    return(_green);
}


/**
    Méthode getBlue renvoyant le tab 2D bleu
**/
vector<vector<int>> Image::getBlue() const{
    return(_blue);
}


/**
Méthode permettant l'affichage de chacun des vecteurs de l'image
**/
void Image::affiche(){
    cout<<"Les vecteurs rouges :"<<endl;
    for (int i = 0; i<_largeur; i++){
        for(int j = 0; j<_longueur; j++)
            cout<<_red[i][j]<<" ";
        cout<<endl;
    }
    cout<<endl;
    cout<<"Les vecteurs verts :"<<endl;
    for (int i = 0; i<_largeur; i++){
        for(int j = 0; j<_longueur; j++)
            cout<<_green[i][j]<<" ";
        cout<<endl;
    }
    cout<<endl;
    cout<<"Les vecteurs bleus :"<<endl;
    for (int i = 0; i<_largeur; i++){
        for(int j = 0; j<_longueur; j++)
            cout<<_blue[i][j]<<" ";
        cout<<endl;
    }
}


/**
    Méthode pour changer la valeur d'un pixel
**/
void Image::changePixel(int i, int j, int rouge, int vert, int bleu){
        _red[i][j] = rouge;
        _green[i][j] = vert;
        _blue[i][j] = bleu;
}


/**
(QUESTION 3) Méthode renvoyant une nouvelle image
en gardant uniquement le rouge de l'image de base,
tous les autres vecteurs bleu et verts sont à 0
**/

Image Image::composanteRouge() const{
    vector<vector<int>> black(_green.size());
    for(int i = 0; i < _largeur; i++){
        for(int j = 0; j < _longueur; j++){
            black[i].push_back(0);
        }
    }
    Image imageR(_red, black, black);
    return imageR;
}

/**
(QUESTION 4) Méthode renvoyant true si le code RVB donné est présent dans l'image
**/

bool Image::detection(int r, int g, int b){
    bool rep = false;
    int i = 0; int j = 0;
    while((i<_largeur) && (j<_longueur) && !rep){
        rep = ((_red[i][j] == r) && (_green[i][j] == g) && (_blue[i][j] == b));
        i++; j++;
    }
    return(rep);
}


/**
(QUESTION 5) Méthode renvoyant une nouvelle image grise en faisant la moyenne
du code RGB pixel par pixel
**/
Image Image::niveauxGris() const{
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;
    int moyenne = 0;

    for(int i = 0; i<_largeur; i++){
            rouge.push_back({});
            vert.push_back({});
            bleu.push_back({});
            for(int j = 0; j<_longueur; j++){
                moyenne = (_red[i][j] + _green[i][j] + _blue[i][j])/3;
                rouge[i].push_back(moyenne);
                vert[i].push_back(moyenne);
                bleu[i].push_back(moyenne);
            }
            moyenne = 0;
    }
    Image imageR(rouge, vert, bleu);
    return imageR;
}


/**
(QUESTION 7) Méthode renvoyant une nouvelle image, si le niveau de gris d'un pixel est
au dessus d'un seuil passé en paramètre, le pixel devient noir. Il est blanc
dans le cas inverse
**/
Image Image::noirEtBlanc(int seuil) const{
    Image gris = niveauxGris();
    int moyenne = 0;
    for(int i = 0; i < _largeur; i++){
        for(int j = 0; j < _longueur; j++){
           moyenne = (gris._red[i][j] + gris._green[i][j] + gris._blue[i][j])/3;
           if(moyenne < seuil){
                gris._red[i][j] = 0;
                gris._green[i][j] = 0;
                gris._blue[i][j] = 0;
           }else{
                gris._red[i][j] = 255;
                gris._green[i][j] = 255;
                gris._blue[i][j] = 255;
           }
        }
    }
    return(gris);
}

/**
(QUESTION 8) Méthode renvoyant un vecteur, pour chaque niveau de gris d'une image,
il y a le nombre de fois où il est présent et son code RGB
**/

vector<int> Image::histogrammeGris() const{
    vector<int> histo(256, 0);
    int val;
    Image imageG = niveauxGris();
    for(int i = 0; i<_largeur; i++){
        for(int j = 0; j<_longueur; j++){
            val = imageG._red[i][j];
            histo[val] += 1;
        }
    }
    return histo;
}

/**
Fonction utilisée pour afficher un unique vecteur et utile pour histogrammesGris
**/

void affiche(vector<int> &histo){
    for (int i = 0; i<histo.size(); i++){
        if (histo[i] > 0)
            cout<<"position "<<i<<" valeur : "<<histo[i]<<endl;
    }
}


/**
(QUESTION 10) Méthode renvoyant une nouvelle image dont la luminosité a été modifié
en multipliant chaque code RGB d'un pixel par une constante
**/
Image Image::luminosity(float factor) const{
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;

    for(int i = 0; i < _largeur; i++){
            rouge.push_back({});
            vert.push_back({});
            bleu.push_back({});
        for(int j = 0; j < _longueur; j++){
            // Cas du Rouge
            if(_red[i][j]*factor>255){
                rouge[i].push_back(_red[i][j]);
            }else{
                rouge[i].push_back(_red[i][j]*factor);
            }
            // Cas du Vert
            if(_green[i][j]*factor>255){
                vert[i].push_back(_green[i][j]);
            }else{
                vert[i].push_back(_green[i][j]*factor);
            }
            // Cas du Bleu
            if(_blue[i][j]*factor>255){
                bleu[i].push_back(_blue[i][j]);
            }else{
                bleu[i].push_back(_blue[i][j]*factor);
            }
        }
    }

    Image imageR(rouge, vert, bleu);
    return(imageR);
}


/**
(QUESTION 10) Méthode renvoyant une nouvelle image 1.5 fois plus lumineuse que celle de base
**/
Image Image::luminosityDOWN() const{
    return luminosity(0.5);
}


/**
(QUESTION 10) Méthode renvoyant une nouvelle image 0.5 fois moins lumineuse que celle de base
**/
Image Image::luminosityUP() const{
    return luminosity(1.5);
}


/**
(QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste modifié,
en prenant chaque valeur d'un pixel, en retirant 128 puis en le multipliant par
une constante pour au final ajouter 128. Si le résultat dépasse 255, c'est tout de
même 255 qui sera ajouté. Même chose avec 0.
**/
Image Image::contraste(float factor) const{
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;


    for(int i = 0; i < _largeur; i++){

            rouge.push_back({});
            vert.push_back({});
            bleu.push_back({});

        for(int j = 0; j < _longueur; j++){

            int contrasteR = (128 + (_red[i][j] - 128)*factor);
            int contrasteV = (128 + (_green[i][j] - 128)*factor);
            int contrasteB = (128 + (_blue[i][j] - 128)*factor);

            // Cas du Rouge
            if(contrasteR > 255){
                rouge[i].push_back(255);
            }else if(contrasteR < 0){
                rouge[i].push_back(0);
            }else{
                rouge[i].push_back(contrasteR);
            }
            // Cas du Vert
            if(contrasteV > 255){
                vert[i].push_back(255);
            }else if(contrasteV < 0){
                vert[i].push_back(0);
            }else{
                vert[i].push_back(contrasteV);
            }
            // Cas du Bleu
            if(contrasteB > 255){
                bleu[i].push_back(255);
            }else if(contrasteB < 0){
                bleu[i].push_back(0);
            }else{
                bleu[i].push_back(contrasteB);
            }
        }
    }

    Image imageR(rouge, vert, bleu);
    return(imageR);
}


/**
(QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste 1.5 fois plus élevé que celle de base
**/
Image Image::contrasteUP() const{
    return(contraste(1.5));
}


/**
(QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste 0.5 fois moins élevé que celle de base
**/
Image Image::contrasteDOWN() const{
    return(contraste(0.5));
}


/**

FIN DE LA PARTIE 1

**/


/**

DÉBUT DE LA PARTIE 2

**/


/**
(QUESTION 1, 5) Fonction permettant de renvoyer une nouvelle image modifiée
selon les choix de l'utilisateur avec toutes les méthodes disponibles
**/
void menu(string &nomFichier, vector<int> &choix){
    int c = 1;
    bool prem = false;
    cout << "Saississez le nom du fichier au format ppm : " << endl;
    cin >> nomFichier;

    while(!seTermineParPPM(nomFichier)){
        cout << "IL FAUT UN FORMAT PPM ! Saississez le nom du fichier au FORMAT PPM : " << endl;
        cin >> nomFichier;
    }

    while(c != 0){
        if(prem) choix.push_back(c);
        cout << "Quelle modification souhaitez-vous appoter à votre image ?" << endl;
        cout<<endl;
        cout << "Pour composanteRouge, entrez 1" << endl;
        cout<<endl;
        cout << "Pour niveauxGris, entrez 2" << endl;
        cout<<endl;
        cout << "Pour noirEtBlanc, entrez 3" << endl;
        cout<<endl;
        cout << "Pour luminosityUP, entrez 4" << endl;
        cout<<endl;
        cout << "Pour luminosityDOWN, entrez 5" << endl;
        cout<<endl;
        cout << "Pour contrasteUP, entrez 6" << endl;
        cout<<endl;
        cout << "Pour contrasteDOWN, entrez 7" << endl;
        cout<<endl;
        cout << "Pour rogner D/G/H/B, entrez respectivement 8, 9, 10, 11" << endl;
        cout<<endl;
        cout << "Pour agrandissement, entrez 12" << endl;
        cout<<endl;
        cout << "Pour retrécissement, entrez 13" << endl;
        cout<<endl;
        cout << "Pour QUITTER, entrez 0" << endl;
        cin >> c;
        prem = true;
    }
}


bool seTermineParPPM(const string& str) {
    if (str.length() >= 4) {
        return str.compare(str.length() - 4, 4, ".ppm") == 0;
    } else {
        return false;
    }
}


void loadPicture(const string &picture, vector<vector<int>> &red,
                                        vector<vector<int>> &green,
                                        vector <vector<int>> &blue)
{
    // Declaration des variables
    string line; // pour recuperer les lignes du fichier image au format .ppm, qui est code en ASCII.
    string format; //pour recuperer le format de l'image : celui-ci doit être de la forme P3
    string name; // au cas où l'utilisateur se trompe dans le nom de l'image a charger, on redemande le nom.
    int taille;
    vector <int> mypixels; // pour recuperer les donnees du fichier de maniere lineaire. On repartira ensuite ces donnees dans les tableaux correspondants
    ifstream entree; // Declaration d'un "flux" qui permettra ensuite de lire les donnees de l'image.
    int hauteur; // pour bien verifier que l'image est carree, et de taille respectant les conditions fixees par l'enonce
    // Initialisation des variables
    name = picture;
    // Permet d'ouvrir le fichier portant le nom picture
    // ouverture du fichier portant le nom picture
    entree.open(name);
    // On verifie que le fichier a bien ete ouvert. Si cela n'est pas le cas, on redemande un nom de fichier valide
    while (!entree){
        //cin.rdbuf(oldbuf);
        cerr << "Erreur! Impossible de lire de fichier " << name << " ! " << endl;
        cerr << "Redonnez le nom du fichier a ouvrir SVP. Attention ce fichier doit avoir un nom du type nom.ppm" << endl;
        cin >> name;
        entree.open(name); // relance
    }
    // Lecture du nombre definissant le format (ici P3)
    entree >> format;
    // on finit de lire la ligne (caractere d'espacement)
    getline(entree, line);
    // Lecture du commentaire
    getline(entree, line);
    //lecture des dimensions
    entree >> taille >> hauteur;
    getline(entree, line); // on finit de lire la ligne (caractere d'espacement)
    // On verifie que l'image a une taille qui verifie bien les conditions requises par l'enonce.
    // Si cela n'est pas le cas, on redemande un fichier valide, et ce, tant que necessaire.
    while (format != "P3"){
        if (format != "P3"){
            cerr << "Erreur! L'image que vous nous avez donnee a un format ne verifiant pas les conditions requises." << endl;
            cerr << "L'image que vous nous avez donnee doit etre codee en ASCII et non en brut." << endl;
        }
	entree.close();
        // On va redemander un nom de fichier valide.
        do{
            cerr << "Veuillez redonner un nom de fichier qui respecte les conditions de format et de taille. Attention, ce nom doit etre de la forme nom.ppm." << endl;
            cin >> name;
            entree.open(name); // relance
        }while(!entree);
         // Lecture du nombre definissant le format (ici P3)
         entree >> format;
         getline(entree, line); // on finit de lire la ligne (caractere d'espacement)
        // Lecture du commentaire
        getline(entree, line);
        //lecture des dimensions
        entree >> taille >> hauteur; // relance
        getline(entree, line); // on finit de lire la ligne (caractere d'espacement)
    }
    //Lecture de la valeur max
    getline(entree, line);
    //Lecture des donnees et ecriture dans les tableaux :
    // Pour plus de simplicite, on stocke d'abord toutes les donnees dans mypixels
    // dans l'ordre de lecture puis ensuite on les repartira dans les differents tableaux.
    //Les donnees stockees dans mypixels sont de la forme RGB RGB RGB ....
    // Il faudra donc repartir les valeurs R correspondant a la composante rouge de l'image
    // dans le tableau red, de même pour G et B.
    int pix;
    mypixels.resize(3*taille*hauteur); // taille fixe : on alloue une fois pour toutes
    for (int i = 0; i < 3*taille*hauteur; i++){
      entree >> pix;
      mypixels[i]=pix;
    }
    // Remplissage des 3 tableaux : on repartit maintenant les valeurs dans les bonnes composantes
    // Comme dans mypixels, les donnees sont stockees de la maniere suivante : RGB RGB RGB, il faut mettre
    // les valeurs correspondant a la composante rouge dans red, ...
    // Ainsi, les valeurs de la composante rouge correspondent aux valeurs stockes aux indices
    // congrus a 0 mod 3 dans mypixels, que les valeurs de la composante verte correspond aux valeurs
    // stockes aux indices sont congrus a 1 mod 3, ...
     // les valeurs d'une ligne
    int val;
    red.resize(hauteur);
    green.resize(hauteur);
    blue.resize(hauteur);
    for (int i = 0; i < hauteur; i++){
      vector <int> ligneR(taille);
      vector <int> ligneB(taille);  // les lignes ont toutes la même taille
      vector <int> ligneG(taille);
      for (int j = 0; j < taille; j++){
            val =  mypixels[3*j + 3*taille*i];
            ligneR[j]=val;
            val = mypixels[3*j + 1 + 3*taille*i];
            ligneG[j]=val;
            val = mypixels[3*j + 2 + 3*taille*i];
            ligneB[j]=val;
        }
        red[i]=ligneR;
        green[i]=ligneG;
        blue[i]=ligneB;
    }
    // Informations a l'utilisateur pour dire que tout s'est bien passe
    cout << " L'image " << name << " a bien ete chargee dans les tableaux ." << endl;
     entree.close();
 }


 /**
 (QUESTION 2) Constructeur créant une image à partir d'un fichier au format ppm
 **/
Image::Image(string nomImg){
    loadPicture(nomImg, _red, _blue, _green);
    _longueur = _red.size();
    _largeur = _red[0].size();
}

/**
(QUESTION 3) Méthode permettant la création d'un fichier contenant l'image au format ppm
**/
void Image::creer(const string &nomFichier){
    ofstream entree;
    entree.open(nomFichier);
    entree << "P3" << endl;
    entree << _largeur << " " << _longueur << endl;
    entree << 255 << endl;

    for(int i = 0; i < _largeur; i++){
        for(int j = 0; j < _longueur; j++){
            entree << _red[i][j] << endl;
            entree << _green[i][j] << endl;
            entree << _blue[i][j] << endl;
        }
    }
}


/**
(QUESTION 4, 5) Méthode appliquant les modifications demandées par l'utilisateur
dans la méthode menu
**/
Image Image::appliquerFiltre(vector<int> choix){
    Image newImage = *this;
    int c;
    for(int i = 0; i < choix.size(); i++){
        c = choix[i];
        switch(c){
        case 1:
            newImage = newImage.composanteRouge(); break;
        case 2:
            newImage = newImage.niveauxGris(); break;
        case 3:
            newImage = newImage.noirEtBlanc(); break;
        case 4:
            newImage = newImage.luminosityUP(); break;
        case 5:
            newImage = newImage.luminosityDOWN(); break;
        case 6:
            newImage = newImage.contrasteUP(); break;
        case 7:
            newImage = newImage.contrasteDOWN(); break;
        case 8:
            newImage = newImage.rognerD(); break;
        case 9:
            newImage = newImage.rognerG(); break;
        case 10:
            newImage = newImage.rognerH(); break;
        case 11:
            newImage = newImage.rognerB(); break;
        case 12:
            newImage = newImage.agrandissement(); break;
        case 13:
            newImage = newImage.retrecissement(); break;
        default:
            break;
        }
    }
    return(newImage);
}




/**

FIN DE LA PARTIE 2

**/


/**

DÉBUT DE LA PARTIE 3

**/

/**
(QUESTION 1) Méthode rognant une image au niveau de la droite en vérifiant que c'est possible
**/
Image Image::rognerD(int num){
    if(num > _longueur){
        cout<<"Erreur, impossible de rogner autant"<<endl;
        return *this;
    }
    int vt = _largeur-num;
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    for(int i = 0; i<_largeur; i++){
        red.push_back({});
        green.push_back({});
        blue.push_back({});
        for(int j = 0; j<vt; j++){
            red[i].push_back(_red[i][j]);
            green[i].push_back(_green[i][j]);
            blue[i].push_back(_blue[i][j]);
        }
    }
    Image im(red, green, blue);
    return im;
}


/**
(QUESTION 1) Méthode rognant une image au niveau de la gauche en vérifiant que c'est possible
**/
Image Image::rognerG(int num){
    if(num > _longueur){
        cout<<"Erreur, impossible de rogner autant"<<endl;
        return *this;
    }
    int vt = num;
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    for(int i = 0; i<_largeur; i++){
        red.push_back({});
        green.push_back({});
        blue.push_back({});
        for(int j = num; j<_longueur; j++){
            red[i].push_back(_red[i][j]);
            green[i].push_back(_green[i][j]);
            blue[i].push_back(_blue[i][j]);
        }
    }
    Image im(red, green, blue);
    return im;
}


/**
(QUESTION 1) Méthode rognant une image au niveau du haut en vérifiant que c'est possible
**/
Image Image::rognerH(int num){
    if(num > _largeur){
        cout<<"Erreur, impossible de rogner autant"<<endl;
        return *this;
    }
    int vt = num;
    int pt = 0;
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    for(int i = num; i<_largeur; i++){
        red.push_back({});
        green.push_back({});
        blue.push_back({});
        for(int j = 0; j<_longueur; j++){
            red[pt].push_back(_red[i][j]);
            green[pt].push_back(_green[i][j]);
            blue[pt].push_back(_blue[i][j]);
        }
        pt++;
    }
    Image im(red, green, blue);
    return im;
}


/**
(QUESTION 1) Méthode rognant une image au niveau du bas en vérifiant que c'est possible
**/
Image Image::rognerB(int num){
    if(num > _largeur){
        cout<<"Erreur, impossible de rogner autant"<<endl;
        return *this;
    }
    int vt = num;
    int pt = 0;
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    for(int i = num; i<_largeur; i++){
        red.push_back({});
        green.push_back({});
        blue.push_back({});
        for(int j = 0; j<_longueur; j++){
            red[pt].push_back(_red[pt][j]);
            green[pt].push_back(_green[pt][j]);
            blue[pt].push_back(_blue[pt][j]);
        }
        pt++;
    }
    Image im(red, green, blue);
    return im;
}


/**
(QUESTION 2) et (QUESTION 3) Méthode rognant une image vers la gauche
**/
Image Image::rotationG() const {
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;

    for (int i = 0; i < _longueur; i++) {
        rouge.push_back({});
        vert.push_back({});
        bleu.push_back({});

        for (int j = 0; j < _largeur; j++) {
            rouge[i].push_back(_red[j][i]);
            vert[i].push_back(_green[j][i]);
            bleu[i].push_back(_blue[j][i]);
        }
    }
    return Image(rouge, vert, bleu);
}


/**
(QUESTION 2) et (QUESTION 3) Méthode rognant une image vers la droite
**/
Image Image::rotationD() const {
    // Création de la nouvelle image (les dimensions sont inversées)
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;

    for (int i = 0; i < _largeur; i++) {
        rouge.push_back({});
        vert.push_back({});
        bleu.push_back({});

        for (int j = 0; j < _longueur; j++) {
            rouge[i].push_back(_red[_largeur - 1 - j][i]);
            vert[i].push_back(_green[_largeur - 1 - j][i]);
            bleu[i].push_back(_blue[_largeur - 1 - j][i]);
        }
    }

    return Image(rouge, vert, bleu);
}


/**
(QUESTION 4) Méthode faisant une symétrie horizontale sur une image
**/
Image Image::retournementH() const {
    // Création de la nouvelle image (retournement horizontal)
    vector<vector<int>> rouge;
    vector<vector<int>> vert;
    vector<vector<int>> bleu;

    for (int i = 0; i < _largeur; i++) {
        rouge.push_back({});
        vert.push_back({});
        bleu.push_back({});

        for (int j = 0; j < _longueur; j++) {
            rouge[i].push_back(_red[i][_longueur - 1 - j]);
            vert[i].push_back(_green[i][_longueur - 1 - j]);
            bleu[i].push_back(_blue[i][_longueur - 1 - j]);
        }
    }

    return Image(rouge, vert, bleu);
}


/**
(QUESTION 4) Méthode faisant une symétrie verticale une image
**/
Image Image::retournementV() const {
    // Création de la nouvelle image (retournement vertical)
    vector<vector<int>> newRed;
    vector<vector<int>> newGreen;
    vector<vector<int>> newBlue;

    for (int i = 0; i < _largeur; i++) {
        newRed.push_back({});
        newGreen.push_back({});
        newBlue.push_back({});

        for (int j = 0; j < _longueur; j++) {
            newRed[i].push_back(_red[_largeur - 1 - i][j]);
            newGreen[i].push_back(_green[_largeur - 1 - i][j]);
            newBlue[i].push_back(_blue[_largeur - 1 - i][j]);
        }
    }

    return Image(newRed, newGreen, newBlue);
}


/**
(QUESTION 5) Méthode renvoyant une nouvelle image num fois plus grande
**/
Image Image::agrandissement(int num)const{
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    for(int i = 0; i<_largeur; i++){
        red.push_back({});
        green.push_back({});
        blue.push_back({});
        for(int j = 0; j<_longueur; j++){
            for(int k = 0; k<num; k++){
                red[i*num].push_back(_red[i][j]);
                green[i*num].push_back(_green[i][j]);
                blue[i*num].push_back(_blue[i][j]);
            }
        }
        for(int l = 0; l<num-1; l++){
            red.push_back(red[i*num]);
            green.push_back(green[i*num]);
            blue.push_back(blue[i*num]);
        }
    }
    Image im(red, green, blue);
    return im;
}


/**
(QUESTION 6) Méthode renvoyant une nouvelle image à partir d'une image (carré ou non)
où chaque pixel équivaut à un carré num x num de l'image de base
**/
Image Image::retrecissement(int num)const{
    while(num > _largeur || num > _longueur){
        cout<<"Impossible d'autant reduire l'image. Veuillez donner un nombre inférieur à "<<_largeur<<" et "<<_longueur<<endl;
        cin>>num;
    }
    vector<vector<int>> red;
    vector<vector<int>> green;
    vector<vector<int>> blue;
    bool pile;
    int reste_lon = _longueur % num;
    int reste_lar = _largeur % num;
    int pointeur_i = -1, pointeur_j = 0;
    int somme = _largeur/num;
    if(_largeur%num != 0){
        somme++;
        pile = true;
    }
    vector<int> base(somme, 0);
    for(int i = 0; i<_largeur; i++){
        if(i<(_largeur-reste_lar)/num || (i == (_largeur-reste_lar)/num && pile)){
            red.push_back(base);
            green.push_back(base);
            blue.push_back(base);
        }
        pointeur_j = -1;
        if(i%num == 0) pointeur_i++;
        for(int j = 0; j<_longueur; j++){
            if(j%num == 0) pointeur_j ++;
            red[pointeur_i][pointeur_j] += _red[i][j];
            green[pointeur_i][pointeur_j] += _green[i][j];
            blue[pointeur_i][pointeur_j] += _blue[i][j];
        }
    }
   for(int i = 0; i<red.size(); i++){
        for(int j = 0; j<red[0].size(); j++){
            red[i][j] /= (num*num);
            green[i][j] /= (num*num);
            blue[i][j] /= (num*num);
       }
    }
    Image rim(red, green, blue);
    return rim;
}


/**

FIN DE LA PARTIE 3

**/


/**

DÉBUT DE LA PARTIE 4

**/

/**
    Constructeur
**/
Filtre::Filtre(vector<vector<float>> action, int rayon){
    _action = action;
    _rayon = rayon;
}


/**
    (Question 1) Méthode application pour appliquer un filtre à une image
**/
Image Filtre::application(const Image &img) const {
        Image imageFiltree(img);

        for (int i = 0; i < img.getLongueur(); i++) {
            for (int j = 0; j < img.getLargeur(); j++) {
                float rouge = 0, vert = 0, bleu = 0;

                for (int x = -_rayon; x <= _rayon; x++) {
                    for (int y = -_rayon; y <= _rayon; y++) {
                        int ni = i + x;
                        int nj = j + y;

                        if ((ni >= 0) && (ni < img.getLongueur()) && (nj >= 0) && (nj < img.getLargeur())) {
                            rouge += _action[x + _rayon][y + _rayon] * img.getRed()[ni][nj];
                            vert += _action[x + _rayon][y + _rayon] * img.getGreen()[ni][nj];
                            bleu += _action[x + _rayon][y + _rayon] * img.getBlue()[ni][nj];
                        }
                    }
                }

                imageFiltree.changePixel(i,j,rouge,vert,bleu);
            }
        }
    return imageFiltree;
};
