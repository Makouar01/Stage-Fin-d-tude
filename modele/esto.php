<?php
include("Connexion.php");


class etudiant extends Connexion {

	private $_table = "etudiant";
	

// la fonction de l'inscription //SYSDATE

		public function add_etudiant($nom,$annee,$cne,$cni,$filier)
		{
			$sql="INSERT INTO {$this->_table} (nom_etudiant,annee,cne,cni,filier,Email,MDP,Date_inscription) VALUES ('$nom','$annee','$cne','$cni','$filier',cne,cni,NOW())";
			$req=$this->getPDO()->query($sql);

		}



	}

	


	class Materiel extends Connexion {

		private $_table = "materiel";
		
	
	// la fonction de l'inscription //SYSDATE
	
			public function add_materiel($nom,$description,$quantite,$marque)
			{
				$sql="INSERT INTO {$this->_table} (nom_materiel,description,quantite,marque,date_entree) VALUES ('$nom','$description','$quantite','$marque',NOW())";
				$req=$this->getPDO()->query($sql);
				
			}
		}
		class Enseignant extends Connexion {

			private $_table = "prof";
			
		
		
				public function add_ensg($nom,$departement,$cni)
				{
					$sql="INSERT INTO {$this->_table} (nom_prof,departement,cni,mdp,email) VALUES ('$nom','$departement','$cni',cni,nom_prof)";
					$req=$this->getPDO()->query($sql);
					
				}
			}
			class demande extends Connexion {

				private $_table = "demande";
				
				
			
			// la fonction de remplie demande //SYSDATE
			
					public function rempli_demandeP($nom_user,$cni_user,$nom_materiel,$marque_materiel,$qauntit)
					{
						$sql="INSERT INTO {$this->_table} (nom_user,cni_user,nom_materiel,marque_materiel,qauntit,date_demande) VALUES ('$nom_user','$cni_user','$nom_materiel','$marque_materiel','$qauntit',NOW())";
						$req=$this->getPDO()->query($sql);
						
					}
				}
				
				
				
