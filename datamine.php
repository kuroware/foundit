<?php
$string = "AAR
Architecture Annex
ACW
Accelerator Centre
AL
Arts Lecture Hall
ARC
School of Architecture
B1
Biology 1
B2
Biology 2
BAU
Bauer Warehouse
BMH
B.C. Matthews Hall
BRH
Brubacher House
C2
Chemistry 2
CGR
Conrad Grebel University College
CIF
Columbia Icefield
CLN
Columbia Lake Village North
CLV
Columbia Lake Village
COG
Columbia Greenhouses
COM
Commissary (UW Police & Parking)
CPH
Carl A. Pollock Hall
CSB
Central Services Building
DC
William G. Davis Computer Research Centre
DWE
Douglas Wright Engineering Building
E2
Engineering 2
E3
Engineering 3
E5
Engineering 5
E6
Engineering 6
EC1
East Campus 1
EC2
East Campus 2
EC3
East Campus 3
ECH
East Campus Hall
EIT
Centre for Environmental and Information Technology
ERC
Energy Research Centre
EV1
Environment 1
EV2
Environment 2
EV3
Environment 3
ESC
Earth Sciences & Chemistry
FED
Federation Hall
GA
Centre for Extended Learning
GH
Graduate House
GSC
General Services Complex
HH
J.G. Hagey Hall of the Humanities
HMN
Hildegard Marsden Nursery
HS
Health Services
HSC
Huntsville Summit Centre
87 Forbes Hill Drive, Huntsville, ON
IHB
Integrated Health Building 1
KDC
Klemmer Day Care
LHI
Lyle S. Hallman Institute for Health Promotion
LIB
Dana Porter Library
M3
Mathematics 3
MC
Mathematics & Computer Building
MHR
Minota Hagey Residence
MKV
William Lyon Mackenzie King Village
ML
Modern Languages
NH
Ira G. Needles Hall
OPT
Optometry Building
PAC
Physical Activities Complex
PAS
Psychology, Anthropology, Sociology
PHR
School of Pharmacy
PHY
Physics
QNC
Mike & Ophelia Lazaridis Quantum-Nano Centre
RA2
Research Advancement Centre 2
RAC
Research Advancement Centre
RCH
J.R. Coutts Engineering Lecture Hall
REN
Renison University College
REV
Ron Eydt Village
SCH
South Campus Hall
SLC
Student Life Centre
STJ
St. Jerome's University
STP
St. Paul's University College
TC
William M. Tatham Centre for Co-operative Education & Career Action
TH
Tutors' Houses
UC
University Club
UWP
University of Waterloo Place
V1
Student Village 1
WSS
Stratford Campus";
$array = array_chunk(explode("\n", $string), 2);
$x = 0;
require_once($_SERVER['DOCUMENT_ROOT'] . '/project-121/objects/objects.php');
$dashboard = new Dashboard();
foreach ($array as $slice) {
	$abbreviation = $dashboard->sanitize($slice[0]);
	$building_name = $dashboard->sanitize($slice[1]);
	$insert_result = mysqli_query($dashboard->dbc, "INSERT INTO buildings (name, parent, abbreviation) VALUES('$building_name', 0, '$abbreviation')")
	or die (mysqli_error($dashboard->dbc));
}

?>
