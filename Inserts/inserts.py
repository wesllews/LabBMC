import csv
import sys, os

from individual import insert_individual #AlteradoSQL #InsertOK
from wild import insert_wild_individual #AlteradoSQL #InsertOK
from institute import insert_institute #AlteradoSQL #InsertOK
from historic import insert_historic #AlteradoSQL #InsertOK
from kinship import insert_kinship #AlteradoSQL #InsertOK
from locus import insert_locus #AlteradoSQL #InsertOK
from genotype import insert_genotypes #AlteradoSQL #InsertOK
from status import insert_status #AlteradoSQL #InsertOK
from wild_location import insert_wild_location



"""
bibliografia:
- https://stackoverflow.com/questions/4383571/importing-files-from-different-folder
"""