################################################################################
#
# perl-linux-inotify2
#
################################################################################

PERL_LINUX_INOTIFY2_VERSION = 1.22
PERL_LINUX_INOTIFY2_SOURCE = Linux-Inotify2-$(PERL_LINUX_INOTIFY2_VERSION).tar.gz
PERL_LINUX_INOTIFY2_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_LINUX_INOTIFY2_DEPENDENCIES = perl-common-sense
PERL_LINUX_INOTIFY2_LICENSE_FILES = COPYING

$(eval $(perl-package))
