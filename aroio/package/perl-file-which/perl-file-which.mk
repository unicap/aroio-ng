################################################################################
#
# perl-file-which
#
################################################################################

PERL_FILE_WHICH_VERSION = 1.22
PERL_FILE_WHICH_SOURCE = File-Which-$(PERL_FILE_WHICH_VERSION).tar.gz
PERL_FILE_WHICH_SITE = $(BR2_CPAN_MIRROR)/authors/id/P/PL/PLICEASE
PERL_FILE_WHICH_LICENSE = Artistic or GPL-1.0+
PERL_FILE_WHICH_LICENSE_FILES = LICENSE

$(eval $(host-perl-package))
