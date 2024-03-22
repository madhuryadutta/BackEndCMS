import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.tag import pos_tag
from nltk.chunk import ne_chunk
from nltk.stem import WordNetLemmatizer
from sklearn.feature_extraction.text import TfidfVectorizer
from string import punctuation
from collections import Counter
import sys

# Download NLTK resources
nltk.download('punkt')
nltk.download('stopwords')
nltk.download('maxent_ne_chunker')
nltk.download('words')
nltk.download('wordnet')
nltk.download('averaged_perceptron_tagger')
nltk.download('maxent_ne_chunker')
nltk.download('words')

def extract_keywords(text, num_keywords=50):
    # Tokenize the text
    words = word_tokenize(text.lower())  # Convert to lowercase for consistency

    # Part-of-speech tagging
    tagged_words = pos_tag(words)

    # Named Entity Recognition
    named_entities = ne_chunk(tagged_words)

    # Lemmatization
    lemmatizer = WordNetLemmatizer()
    lemmatized_words = [lemmatizer.lemmatize(word, pos=get_wordnet_pos(pos_tag))
                        for word, pos_tag in tagged_words]

    # Filter out named entities and stopwords
    stop_words = set(stopwords.words('english'))
    filtered_words = [word for word, pos_tag in tagged_words if pos_tag != 'NNP' and word.lower() not in stop_words
                      and word not in punctuation]

    # Generate TF-IDF features
    tfidf_vectorizer = TfidfVectorizer(max_features=1000)  # Adjust max_features as needed
    tfidf_matrix = tfidf_vectorizer.fit_transform([' '.join(filtered_words)])

    # Get feature names (words)
    feature_names = tfidf_vectorizer.get_feature_names_out()

    # Map feature indices to feature names
    feature_index_to_word = {i: feature_names[idx] for idx, i in enumerate(tfidf_matrix.nonzero()[1])}

    # Sort feature indices by TF-IDF score
    sorted_indices = sorted(feature_index_to_word.keys(), key=lambda x: tfidf_matrix[0, x], reverse=True)

    # Get top keywords based on TF-IDF score
    top_keywords = [feature_index_to_word[idx] for idx in sorted_indices[:num_keywords]]

    return top_keywords

def get_wordnet_pos(treebank_tag):
    if treebank_tag.startswith('J'):
        return 'a'  # Adjective
    elif treebank_tag.startswith('V'):
        return 'v'  # Verb
    elif treebank_tag.startswith('N'):
        return 'n'  # Noun
    elif treebank_tag.startswith('R'):
        return 'r'  # Adverb
    else:
        return 'n'  # Default to noun

def extract_entities(text):
    entities = []
    for sent in nltk.sent_tokenize(text):
        for chunk in nltk.ne_chunk(nltk.pos_tag(nltk.word_tokenize(sent))):
            if hasattr(chunk, 'label'):
                entities.append(' '.join(c[0] for c in chunk))
    return entities

try:
    # Input text from command line argument
    text = sys.argv[1]
    
    # Extract keywords
    keywords = extract_keywords(text)

    # Extract named entities
    entities = extract_entities(text)

    # Combine keywords and entities for tags
    tags = set(keywords + entities)

    # Output the tags as a comma-separated string
    print(','.join(tags))
except IndexError:
    print("Error: No input text provided")
    sys.exit(1)
except Exception as e:
    print("Error:", e)
    sys.exit(1)
