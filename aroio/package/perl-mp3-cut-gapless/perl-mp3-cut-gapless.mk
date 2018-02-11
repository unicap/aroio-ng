################################################################################
#
# perl-mp3-cut-gapless
#
################################################################################

PERL_MP3_CUT_GAPLESS_VERSION = 0.03
PERL_MP3_CUT_GAPLESS_SOURCE = MP3-Cut-Gapless-$(PERL_MP3_CUT_GAPLESS_VERSION).tar.gz
PERL_MP3_CUT_GAPLESS_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AG/AGRUNDMA
PERL_MP3_CUT_GAPLESS_DEPENDENCIES = perl-audio-cuefile-parser

$(eval $(perl-package))
