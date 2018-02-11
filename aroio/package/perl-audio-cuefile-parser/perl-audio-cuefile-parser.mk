################################################################################
#
# perl-audio-cuefile-parser
#
################################################################################

PERL_AUDIO_CUEFILE_PARSER_VERSION = 0.02
PERL_AUDIO_CUEFILE_PARSER_SOURCE = Audio-Cuefile-Parser-$(PERL_AUDIO_CUEFILE_PARSER_VERSION).tar.gz
PERL_AUDIO_CUEFILE_PARSER_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MA/MATTK
PERL_AUDIO_CUEFILE_PARSER_LICENSE_FILES = README

$(eval $(perl-package))
