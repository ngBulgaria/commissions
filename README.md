# commissions
Commission Calculator

git clone https://github.com/ngBulgaria/commissions.git

navigate to folder and white $ php script.php input.csv

app/Calculator/Config
  - configuration file for global constant variables
app/Calculator/Moldes
  - command line arguments construction
app/Calculator/Controllers
  - Math.php - a class for rounding up numbers depending on the transaction currency
  - LegalCashIn.php LegalCashOut.php - classes for operations done by legal user
  - NaturalCashIn.php NaturalCashOut.php - classes for operations done by natural user
  - ParseCommandLine.php - class for getting and validating command line input
  - ParseInput.php - a class for listing csv file as rows /trasnactions/
  - PrintOutput.php - a class for discount table in memory which
  is flushed after new week occurs and updating after every natural user cashes out
