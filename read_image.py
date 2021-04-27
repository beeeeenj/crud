import docx
import os
import docx2txt

dir_path = os.path.dirname(os.path.realpath(__file__))

# text = docx2txt.process(dir_path+'/Document1.docx', 'img_folder/') 


# Extract the images to img_folder/

docx2txt.process(dir_path+'/Document1.docx', 'img_folder2/')
doc = docx.Document(dir_path+'/Document1.docx')


# Save all 'rId:filenames' relationships in an dictionary named rels


rels = {}
for r in doc.part.rels.values():
    if isinstance(r._target, docx.parts.image.ImagePart):
        rels[r.rId] = os.path.basename(r._target.partname)

for paragraph in doc.paragraphs:
	if 'Graphic' in paragraph._p.xml:
		for rId in rels:
			if rId in paragraph._p.xml:
				print(rels[rId])